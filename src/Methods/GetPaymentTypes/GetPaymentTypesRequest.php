<?php

namespace TopSoft4U\Connector\Methods\GetPaymentTypes;

use TopSoft4U\Connector\Abstracts\GetMethod;
use TopSoft4U\Connector\Utils\CountryIso;
use TopSoft4U\Connector\Utils\IdList;

class GetPaymentTypesRequest extends GetMethod
{
    public CountryIso $country;

    public ?IdList $id = null;
    public ?string $modified = null;
    public ?string $name = null;
    public ?IdList $fkShipmentType = null;

    public function __construct(CountryIso $country)
    {
        $this->country = $country;
    }

    public function getUrl(): string
    {
        return "/getPaymentTypes";
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

        if ($this->fkShipmentType !== null)
            $result["fkshipmenttype"] = $this->fkShipmentType;

        return $result;
    }

    public function formatData($data): GetPaymentTypesResponse
    {
        $result = new GetPaymentTypesResponse();
        foreach ($data as $row) {
            $result->items[] = GetPaymentTypesItem::FromData($row);
        }

        return $result;
    }
}
