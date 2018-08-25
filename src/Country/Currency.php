<?php

namespace Yosmy\Country;

class Currency
{
    /**
     * @var string
     */
    private $code;

    /**
     * @param string $code
     */
    public function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'code' => $this->getCode(),
        ];
    }
}
