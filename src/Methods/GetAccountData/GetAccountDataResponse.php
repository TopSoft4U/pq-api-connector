<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetAccountData;

class GetAccountDataResponse
{
    public ?string $firstName = null;
    public ?string $lastName = null;
    public ?string $name = null;

    public bool $isCompany;
    public bool $dropshipping;

    public ?string $currency = null;

    public ?string $countryInvoice = null;
    public ?string $cityInvoice = null;
    public ?string $postalCodeInvoice = null;
    public ?string $streetInvoice = null;
    public ?string $buildingNoInvoice = null;
    public ?string $flatNoInvoice = null;

    public ?string $countrySend = null;
    public ?string $citySend = null;
    public ?string $postalCodeSend = null;
    public ?string $streetSend = null;
    public ?string $buildingNoSend = null;
    public ?string $flatNoSend = null;

    public ?string $email = null;
    public ?string $phone = null;

    public ?string $imNo = null;
    public ?string $imType = null;

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $item = new self();
        $item->firstName = is_string($data["firstname"]) ? $data["firstname"] : null;
        $item->lastName = is_string($data["lastname"]) ? $data["lastname"] : null;
        $item->name = is_string($data["name"]) ? $data["name"] : null;
        $item->isCompany = (bool)$data["iscompany"];
        $item->dropshipping = (bool)$data["dropshipping"];

        $item->currency = is_string($data["currency"] ?? null) ? $data["currency"] : null;

        $item->countryInvoice = is_string($data["country_i"]) ? $data["country_i"] : null;
        $item->cityInvoice = is_string($data["city_i"]) ? $data["city_i"] : null;
        $item->postalCodeInvoice = is_string($data["postalcode_i"]) ? $data["postalcode_i"] : null;
        $item->streetInvoice = is_string($data["street_i"]) ? $data["street_i"] : null;
        $item->buildingNoInvoice = is_string($data["buildingno_i"]) ? $data["buildingno_i"] : null;
        $item->flatNoInvoice = is_string($data["flatno_i"]) ? $data["flatno_i"] : null;

        $item->countrySend = is_string($data["country_s"]) ? $data["country_s"] : null;
        $item->citySend = is_string($data["city_s"]) ? $data["city_s"] : null;
        $item->postalCodeSend = is_string($data["postalcode_s"]) ? $data["postalcode_s"] : null;
        $item->streetSend = is_string($data["street_s"]) ? $data["street_s"] : null;
        $item->buildingNoSend = is_string($data["buildingno_s"]) ? $data["buildingno_s"] : null;
        $item->flatNoSend = is_string($data["flatno_s"]) ? $data["flatno_s"] : null;

        $item->email = is_string($data["email"]) ? $data["email"] : null;
        $item->phone = is_string($data["phone"]) ? $data["phone"] : null;
        $item->imNo = is_string($data["imno"]) ? $data["imno"] : null;
        $item->imType = is_string($data["imtype"]) ? $data["imtype"] : null;

        return $item;
    }
}
