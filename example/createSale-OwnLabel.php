<?php

require_once __DIR__ . "/globals.php";

use TopSoft4U\Connector\Methods\CreateSale\CreateSaleOwnLabel;
use TopSoft4U\Connector\Methods\CreateSale\CreateSaleOwnLabelItem;
use TopSoft4U\Connector\Methods\CreateSale\CreateSaleOwnLabelMode;
use TopSoft4U\Connector\Methods\CreateSale\CreateSaleProduct;
use TopSoft4U\Connector\Methods\CreateSale\CreateSaleRequest;
use TopSoft4U\Connector\Methods\CreateSale\CreateSaleShipping;
use TopSoft4U\Connector\PQApiClient;
use TopSoft4U\Connector\Utils\CountryIso;
use TopSoft4U\Connector\Utils\Currency;
use TopSoft4U\Connector\Utils\Language;
use TopSoft4U\Connector\Utils\SaleDocType;

global $host, $apiKey;

$client = new PQApiClient($host, $apiKey);
$client->setLanguage(Language::English());

/**
 * @see \TopSoft4U\Connector\Methods\GetAvailableDeliveryOptions\GetAvailableDeliveryOptionsRequest - use this class to get available delivery options
(fkShipmentType, fkPaymentType)
 */
// Don't take IDs below as granted, they are just examples from testing environment
$request = new CreateSaleRequest(90, 8, SaleDocType::INVOICE());
$request->currency = Currency::PLN();

// Always do this as a drop-shipping seller and put the customer's data here
// If you are not a drop-shipping seller, you can skip this part if your invoice and delivery data are the same
$delivery = new CreateSaleShipping();
$delivery->receiverName = "John Doe";
$delivery->postalCode = "00-000";
$delivery->city = "Warsaw";
$delivery->street = "Testowa";
$delivery->homeNumber = "1";
$delivery->phone = "123456789";
$delivery->email = "john.doe@test.com";
$delivery->country = new CountryIso("PL");
$request->setDifferentDelivery($delivery);

$request->products = [
    new CreateSaleProduct(68225,3),
    new CreateSaleProduct(70846, 2),
    new CreateSaleProduct(71390, 10),
];

$request->ownLabel = new CreateSaleOwnLabel();
$request->ownLabel->mode = CreateSaleOwnLabelMode::PDF();
$request->ownLabel->provider = "dpd";

$samplePDFUrl = "https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf";
$content = base64_encode(file_get_contents($samplePDFUrl));

$label = new CreateSaleOwnLabelItem();
$label->trackingNo = "123456789012345";
$label->data = $content;

$label2 = new CreateSaleOwnLabelItem();
$label2->trackingNo = "123456789012377";
$label2->data = $content;

$request->ownLabel->items = [
    $label,
    $label2,
];

$response = $client->sendRequest($request);
$result = $request->formatData($response);

var_dump($result);
