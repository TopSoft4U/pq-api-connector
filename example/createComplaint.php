<?php

require_once __DIR__ . "/globals.php";

use TopSoft4U\Connector\Methods\CreateComplaint\CreateComplaintDelivery;
use TopSoft4U\Connector\Methods\CreateComplaint\CreateComplaintRequest;
use TopSoft4U\Connector\Methods\CreateComplaint\CreateComplaintReturnAddress;
use TopSoft4U\Connector\Methods\GetComplaintTypeOptions\GetComplaintTypeOptionsRequest;
use TopSoft4U\Connector\PQApiClient;
use TopSoft4U\Connector\Utils\CountryIso;
use TopSoft4U\Connector\Utils\Language;

global $host, $apiKey;

$client = new PQApiClient($host, $apiKey);
$client->setLanguage(Language::English());

$saleId = 420507;
$productId = 68225;
/**
 * @see \TopSoft4U\Connector\Methods\GetComplaintTypeOptions\GetComplaintTypeOptionsRequest - use this class to get available types for selected sale
 */

$typesRequest = new GetComplaintTypeOptionsRequest($saleId, $productId); // For specific sale and product
//$typesRequest = new GetComplaintTypeOptionsRequest($saleId, 0); // For entire sale

$response = $client->sendRequest($typesRequest);
$types = $typesRequest->formatData($response);
$types = array_filter($types->items, fn($item) => !$item->disabled);

// Don't take IDs below as granted, they are just examples from testing environment
$request = new CreateComplaintRequest(
    $saleId,
    2, // Take it from $typesRequest response
    $productId,
    1,
    "Description for complaint\nNew line",
    "PL1234 1234 1234 1234 1234 1234",
    "SWIFTCODE",
);

// Only specify this field if the product return address (where we have to send the product) differs from the sale shipping address.
$returnAddress = new CreateComplaintReturnAddress();
$returnAddress->receiverName = "John Doe";
$returnAddress->postalCode = "00-000";
$returnAddress->city = "Warsaw";
$returnAddress->street = "Testowa";
$returnAddress->homeNumber = "1";
$returnAddress->phone = "123456789";
$returnAddress->email = "john.doe@test.com";
$returnAddress->country = new CountryIso("PL");
$request->returnAddress = $returnAddress;

// Only specify this field if the product has to be delivered with different delivery method than the one used in the sale.
// Mandatory if own label was submitted in the sale.
$delivery = new CreateComplaintDelivery(37);
$delivery->pickupPoint = "PICKUP_POINT"; // Only required if the delivery method is a pickup point
$request->delivery = $delivery;

$imageUrl1 = "https://placehold.co/600x400/jpg";
$tempFile1 = tempnam(sys_get_temp_dir(), 'tmp');
file_put_contents($tempFile1, file_get_contents($imageUrl1));

$imageUrl2 = "https://placehold.co/300x200/png";
$tempFile2 = tempnam(sys_get_temp_dir(), 'tmp');
file_put_contents($tempFile2, file_get_contents($imageUrl2));

$request->addPicture(new CURLFile($tempFile1, "image/jpeg", "file1.jpg"));
$request->addPicture(new CURLFile($tempFile2, "image/png", "file2.png"));

$response = $client->sendRequest($request);
$result = $request->formatData($response);

var_dump($result);
