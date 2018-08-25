<?php

namespace Yosmy\Country;

/**
 * @di\service()
 */
class ResolveCurrencies
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
     * @return Currency[]
     *
     * @throws NotFoundException
     */
    public function resolve(string $iso): array
    {
        $countries = $this->loadCountries->load();

        foreach ($countries as $country) {
            if ($country['cca2'] != $iso) {
                continue;
            }

            $currencies = [];

            foreach ($country['currencies'] as $code => $currency) {
                $currencies[] = new Currency($code);
            }

            return $currencies;
        }

        throw new NotFoundException();
    }
}
