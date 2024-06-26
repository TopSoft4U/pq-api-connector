<?php

namespace TopSoft4U\Connector\Methods\GetPaymentTypes;

use TopSoft4U\Connector\Abstracts\GetRequest;
use TopSoft4U\Connector\Utils\CountryIso;
use TopSoft4U\Connector\Utils\Date;

class GetPaymentTypesRequest extends GetRequest
{
    public CountryIso $country;

    public ?array $id = null;
    public ?Date $modified = null;
    public ?string $name = null;
    public ?array $fkShipmentType = null;

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

        if ($this->modified !== null)
            $result['modified'] = $this->modified;

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
