<?php

require_once __DIR__ . "/globals.php";

use TopSoft4U\Connector\Methods\GetAvailableDeliveryOptions\GetAvailableDeliveryOptionsRequest;
use TopSoft4U\Connector\PQApiClient;
use TopSoft4U\Connector\Utils\CountryIso;
use TopSoft4U\Connector\Utils\Currency;
use TopSoft4U\Connector\Utils\Language;

global $host, $apiKey;

$client = new PQApiClient($host, $apiKey);
$client->setLanguage(Language::English());

$request = new GetAvailableDeliveryOptionsRequest(
    new CountryIso("PL"),
    Currency::PLN(),
    100,
    5,
);
$response = $client->sendRequest($request);
$result = $request->formatData($response);

var_dump($result);
