<?php

namespace Yosmy\Country;

class Country
{
    /**
     * @var Iso
     */
    private $iso;

    /**
     * @var Name
     */
    private $name;

    /**
     * @var Phone
     */
    private $phone;

    /**
     * @param Iso   $iso
     * @param Name  $name
     * @param Phone $phone
     */
    public function __construct(Iso $iso, Name $name, Phone $phone)
    {
        $this->iso = $iso;
        $this->name = $name;
        $this->phone = $phone;
    }

    /**
     * @return Iso
     */
    public function getIso(): Iso
    {
        return $this->iso;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return Phone
     */
    public function getPhone(): Phone
    {
        return $this->phone;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'iso' => $this->getIso()->jsonSerialize(),
            'name' => $this->getName()->jsonSerialize(),
            'phone' => $this->getPhone()->jsonSerialize(),
        ];
    }
}
