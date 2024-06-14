<?php

namespace TopSoft4U\Connector\Methods\GetAccountData;

class GetAccountDataResponse
{
    public ?string $firstName = null;
    public ?string $lastName = null;
    public ?string $name = null;

    public bool $isCompany;
    public bool $dropshipping;

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

    public static function FromData(array $data): self
    {
        $item = new self();
        $item->firstName = $data["firstname"];
        $item->lastName = $data["lastname"];
        $item->name = $data["name"];
        $item->isCompany = $data["iscompany"];
        $item->dropshipping = $data["dropshipping"];

        $item->countryInvoice = $data["country_i"];
        $item->cityInvoice = $data["city_i"];
        $item->postalCodeInvoice = $data["postalcode_i"];
        $item->streetInvoice = $data["street_i"];
        $item->buildingNoInvoice = $data["buildingno_i"];
        $item->flatNoInvoice = $data["flatno_i"];

        $item->countrySend = $data["country_s"];
        $item->citySend = $data["city_s"];
        $item->postalCodeSend = $data["postalcode_s"];
        $item->streetSend = $data["street_s"];
        $item->buildingNoSend = $data["buildingno_s"];
        $item->flatNoSend = $data["flatno_s"];

        $item->email = $data["email"];
        $item->phone = $data["phone"];
        $item->imNo = $data["imno"];
        $item->imType = $data["imtype"];

        return $item;
    }
}
