<?php

namespace Yosmy\Country;

/**
 * @di\service()
 */
class ResolveName
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
     * @return Name
     *
     * @throws NotFoundException
     */
    public function resolve(string $iso): Name
    {
        $countries = $this->loadCountries->load();

        foreach ($countries as $country) {
            if ($country['cca2'] != $iso) {
                continue;
            }

            $translations = [];

            foreach ($country['translations'] as $language => $translation) {
                $translations[$language] = $translation['common'];
            }

            return new Name(
                $country['name']['common'],
                $translations
            );
        }

        throw new NotFoundException();
    }
}
