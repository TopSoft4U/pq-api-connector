<?php

namespace TopSoft4U\Connector\Methods\GetGPSREntities;

use TopSoft4U\Connector\Utils\CountrySimple;

class GetGPSREntitiesItem
{
    public int $id;
    public string $name;
    public string $postalCode;
    public string $city;
    public string $street;

    public ?string $email = null;
    public ?string $phone = null;
    public ?string $url = null;

    public CountrySimple $country;

    public static function FromData(array $row): self
    {
        $item = new self();
        $item->id = $row["id"];
        $item->name = $row["name"];
        $item->postalCode = $row["postalcode"];
        $item->city = $row["city"];
        $item->street = $row["street"];
        $item->email = $row["email"];
        $item->phone = $row["phone"];
        $item->url = $row["url"];
        $item->country = new CountrySimple($row["country"]["id"], $row["country"]["name"], $row["country"]["iso"]);

        return $item;
    }
}
