<?php

require_once __DIR__ . "/globals.php";

use TopSoft4U\Connector\Methods\AddProductsToSale\AddProductsToSaleRequest;
use TopSoft4U\Connector\Methods\CreateSale\CreateSaleProduct;
use TopSoft4U\Connector\PQApiClient;
use TopSoft4U\Connector\Utils\Language;

global $host, $apiKey;

$client = new PQApiClient($host, $apiKey);
$client->setLanguage(Language::English());

// Don't take IDs below as granted, they are just examples from testing environment
$request = new AddProductsToSaleRequest(420508, [
    new CreateSaleProduct(68225,3),
    new CreateSaleProduct(70846, 2),
]);

$response = $client->sendRequest($request);
$result = $request->formatData($response);

var_dump($result);
