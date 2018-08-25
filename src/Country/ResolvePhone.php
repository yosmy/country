<?php

namespace Yosmy\Country;

/**
 * @di\service()
 */
class ResolvePhone
{
    /**
     * @var LoadCountries
     */
    private $loadCountries;

    /**
     * @param LoadCountries $loadCountries
     */
    public function __construct(LoadCountries $loadCountries)
    {
        $this->loadCountries = $loadCountries;
    }

    /**
     * @param string $iso
     *
     * @return Phone
     *
     * @throws NotFoundException
     */
    public function resolve(string $iso): Phone
    {
        $countries = $this->loadCountries->load();

        foreach ($countries as $country) {
            if ($country['cca2'] != $iso) {
                continue;
            }

            return new Phone($country['callingCode']);
        }

        throw new NotFoundException();
    }
}
