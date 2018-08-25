<?php

namespace Yosmy\Country;

use LogicException;

/**
 * @di\service()
 */
class CollectCountries
{
    /**
     * @var LoadCountries
     */
    private $loadCountries;

    /**
     * @var ResolveName
     */
    private $resolveName;

    /**
     * @var ResolvePhone
     */
    private $resolvePhone;

    /**
     * @param LoadCountries $loadCountries
     * @param ResolveName   $resolveName
     * @param ResolvePhone  $resolvePhone
     */
    public function __construct(
        LoadCountries $loadCountries,
        ResolveName $resolveName,
        ResolvePhone $resolvePhone
    ) {
        $this->loadCountries = $loadCountries;
        $this->resolveName = $resolveName;
        $this->resolvePhone = $resolvePhone;
    }

    /**
     * @return Country[]
     */
    public function collect(): array
    {
        $countries = [];

        foreach ($this->loadCountries->load() as $country) {
            try {
                $name = $this->resolveName->resolve($country['cca2']);
            } catch (NotFoundException $e) {
                throw new LogicException(null, null, $e);
            }

            try {
                $phone = $this->resolvePhone->resolve($country['cca2']);
            } catch (NotFoundException $e) {
                throw new LogicException(null, null, $e);
            }

            $countries[] = new Country(
                new Iso($country['cca2']),
                $name,
                $phone
            );
        }

        return $countries;
    }
}
