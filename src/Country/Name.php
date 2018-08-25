<?php

namespace Yosmy\Country;

use JsonSerializable;

class Name implements JsonSerializable
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var string[]
     */
    private $translations;

    /**
     * @param string $value
     * @param string[] $translations
     */
    public function __construct(string $value, array $translations)
    {
        $this->value = $value;
        $this->translations = $translations;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string[]
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'value' => $this->getValue(),
            'translations' => $this->getTranslations(),
        ];
    }
}
