<?php

require_once __DIR__ . "/globals.php";

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
$client->setTestMode(true); // Only set this if you don't want to create an order, only to test the execution

/**
 * @see \TopSoft4U\Connector\Methods\GetAvailableDeliveryOptions\GetAvailableDeliveryOptionsRequest - use this class to get available delivery options
 (fkShipmentType, fkPaymentType)
 */
// Don't take IDs below as granted, they are just examples from testing environment
$request = new CreateSaleRequest(37, 8, SaleDocType::INVOICE());
$request->currency = Currency::PLN();
$request->notice = "Test notice\nTest notice 2";
$request->isAssembling = false; // If you don't plan on adding more products after submitting this request, set this to false

// If you don't use pickup points, you can skip this line
$request->pickupPoint = "PICKUP_POINT_ID"; // Unique ID of the pickup point from Pickup Point Provider.

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

$response = $client->sendRequest($request);
$result = $request->formatData($response);

var_dump($result);
