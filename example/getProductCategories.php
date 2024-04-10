<?php

require_once __DIR__ . "/globals.php";

use TopSoft4U\Connector\Methods\GetProductCategories\GetProductCategoriesRequest;
use TopSoft4U\Connector\PQApiClient;
use TopSoft4U\Connector\Utils\Date;
use TopSoft4U\Connector\Utils\Language;

global $host, $apiKey;

$client = new PQApiClient($host, $apiKey);
$client->setLanguage(Language::English());

$request = new GetProductCategoriesRequest();
$request->modified = new Date("2021-01-01");
$request->adult = true;
$response = $client->sendRequest($request);
$result = $request->formatData($response);

var_dump($result);
