<?php

use TopSoft4U\Connector\Methods\GetSale\GetSaleRequest;
use TopSoft4U\Connector\PQApiClient;
use TopSoft4U\Connector\Utils\Language;

require_once __DIR__ . "/globals.php";

global $host, $apiKey;

$client = new PQApiClient($host, $apiKey);
$client->setLanguage(Language::English());

$request = new GetSaleRequest(419419);
$response = $client->sendRequest($request);
$result = $request->formatData($response);

var_dump($result);
