<?php

namespace TopSoft4U\Connector\Methods\GetAvailableDeliveryOptions;

use TopSoft4U\Connector\Abstracts\GetMethod;
use TopSoft4U\Connector\Utils\CountryIso;
use TopSoft4U\Connector\Utils\Currency;

class GetAvailableDeliveryOptionsRequest extends GetMethod
{
    public CountryIso $country;
    public Currency $currency;

    /**
     * In currency @see $currency
     * @var float
     */
    public float $priceGross;

    /**
     * In kg
     * @var float
     */
    public float $weightGross;

    public function __construct(CountryIso $country, Currency $currency, float $priceGross, float $weightGross)
    {
        $this->country = $country;
        $this->currency = $currency;
        $this->priceGross = $priceGross;
        $this->weightGross = $weightGross;
    }

    public function getUrl(): string
    {
        return "/getAvailableDeliveryOptions";
    }

    public function getQueryParams(): array
    {
        return [
            "country" => $this->country,
            "currency" => $this->currency,
            "pricegross" => $this->priceGross,
            "weightgross" => $this->weightGross
        ];
    }

    public function formatData($data): GetAvailableDeliveryOptionsResponse
    {
        $result = new GetAvailableDeliveryOptionsResponse();
        foreach ($data as $row) {
            $result->items[] = GetAvailableDeliveryOptionsItem::FromData($row);
        }

        return $result;
    }
}
