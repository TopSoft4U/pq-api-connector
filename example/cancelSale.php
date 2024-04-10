<?php

require_once __DIR__ . "/globals.php";

use TopSoft4U\Connector\Methods\CancelSale\CancelSaleRequest;
use TopSoft4U\Connector\PQApiClient;
use TopSoft4U\Connector\Utils\Language;

global $host, $apiKey;

$client = new PQApiClient($host, $apiKey);
$client->setLanguage(Language::English());

// Don't take IDs below as granted, they are just examples from testing environment
$request = new CancelSaleRequest(420508);

$response = $client->sendRequest($request);
$result = $request->formatData($response);

var_dump($result);
