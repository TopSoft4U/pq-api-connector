<?php

namespace TopSoft4U\Connector\Methods\CreateSale;

use JsonSerializable;
use TopSoft4U\Connector\Utils\CountryIso;

class CreateSaleShipping implements JsonSerializable
{
    public string $receiverName;
    public string $postalCode;
    public string $city;
    public string $street;
    public ?string $homeNumber = null;
    public ?string $flatNumber = null;
    public string $phone;
    public string $email;
    public CountryIso $country;

    public function jsonSerialize(): array
    {
        $result = [];

        $result["receiver_name"] = $this->receiverName;
        $result["postal_code"] = $this->postalCode;
        $result["city"] = $this->city;
        $result["street"] = $this->street;

        if ($this->homeNumber !== null)
            $result["home_number"] = $this->homeNumber;

        if ($this->flatNumber !== null)
            $result["flat_number"] = $this->flatNumber;

        $result["phone"] = $this->phone;
        $result["email"] = $this->email;
        $result["country"] = $this->country;

        return $result;
    }
}
