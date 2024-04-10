<?php

require_once __DIR__ . "/globals.php";

use TopSoft4U\Connector\Methods\GetProductAttributes\GetProductAttributeRequest;
use TopSoft4U\Connector\PQApiClient;
use TopSoft4U\Connector\Utils\Language;

global $host, $apiKey;

$client = new PQApiClient($host, $apiKey);
$client->setLanguage(Language::English());

$request = new GetProductAttributeRequest();
$request->id = [55216];
$request->categoryId = 4098;
$response = $client->sendRequest($request);
$result = $request->formatData($response);

var_dump($result);
