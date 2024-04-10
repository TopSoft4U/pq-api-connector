<?php

require_once __DIR__ . "/globals.php";

use TopSoft4U\Connector\Methods\GetPaymentTypes\GetPaymentTypesRequest;
use TopSoft4U\Connector\PQApiClient;
use TopSoft4U\Connector\Utils\CountryIso;
use TopSoft4U\Connector\Utils\Date;
use TopSoft4U\Connector\Utils\Language;

global $host, $apiKey;

$client = new PQApiClient($host, $apiKey);
$client->setLanguage(Language::English());

$request = new GetPaymentTypesRequest(new CountryIso("PL"));
$request->modified = new Date("2021-01-01");
$response = $client->sendRequest($request);
$result = $request->formatData($response);

var_dump($result);
