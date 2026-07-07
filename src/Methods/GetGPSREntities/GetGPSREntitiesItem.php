<?php
declare(strict_types=1);

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

    /**
     * @param array<string, mixed> $row
     */
    public static function FromData(array $row): self
    {
        $item = new self();
        $item->id = is_numeric($row["id"]) ? (int)$row["id"] : 0;
        $item->name = is_string($row["name"]) ? $row["name"] : "";
        $item->postalCode = is_string($row["postalcode"]) ? $row["postalcode"] : "";
        $item->city = is_string($row["city"]) ? $row["city"] : "";
        $item->street = is_string($row["street"]) ? $row["street"] : "";
        $item->email = is_string($row["email"]) ? $row["email"] : null;
        $item->phone = is_string($row["phone"]) ? $row["phone"] : null;
        $item->url = is_string($row["url"]) ? $row["url"] : null;
        $country = $row["country"];
        $cId = is_array($country) && is_numeric($country["id"] ?? null) ? (int)$country["id"] : 0;
        $cName = is_array($country) && is_string($country["name"] ?? null) ? $country["name"] : "";
        $cIso = is_array($country) && is_string($country["iso"] ?? null) ? $country["iso"] : "";
        $item->country = new CountrySimple($cId, $cName, $cIso);

        return $item;
    }
}
