<?php

namespace TopSoft4U\Connector\Methods\GetShipmentTypes;

use TopSoft4U\Connector\Abstracts\GetMethod;
use TopSoft4U\Connector\Utils\CountryIso;
use TopSoft4U\Connector\Utils\IdList;

class GetShipmentTypesRequest extends GetMethod
{
    public CountryIso $country;

    public ?IdList $id = null;
    public ?string $modified = null;
    public ?string $name = null;
    public ?float $weight = null;

    public function __construct(CountryIso $country)
    {
        $this->country = $country;
    }

    public function getUrl(): string
    {
        return "/getShipmentTypes";
    }

    public function getQueryParams(): array
    {
        $result = [
            "country" => $this->country,
        ];

        if ($this->id !== null)
            $result["id"] = $this->id;

        if ($this->modified !== null) {
            // Validate format yyyy-MM-dd
            $date = \DateTime::createFromFormat('Y-m-d', $this->modified);
            if ($date === false)
                throw new \Exception("Invalid date format - expected yyyy-MM-dd");

            $result['modified'] = $this->modified;
        }

        if ($this->name !== null)
            $result["name"] = $this->name;

        if ($this->weight !== null)
            $result['weight'] = $this->weight;

        return $result;
    }

    public function formatData($data): GetShipmentTypesResponse
    {
        $result = new GetShipmentTypesResponse();
        foreach ($data as $row) {
            $result->items[] = GetShipmentTypesItem::FromData($row);
        }

        return $result;
    }
}
