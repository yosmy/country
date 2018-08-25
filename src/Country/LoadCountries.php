<?php

namespace Yosmy\Country;

/**
 * @di\service({private: true})
 */
class LoadCountries
{
    /**
     * @return array
     */
    public function load(): array
    {
        $json = sprintf('%s/../../data/countries.json', __DIR__);

        return json_decode(file_get_contents($json), true);
    }
}
