<?php

use TopSoft4U\Connector\Methods\GetSaleECOD\GetSaleECODRequest;
use TopSoft4U\Connector\PQApiClient;
use TopSoft4U\Connector\Utils\Language;

require_once __DIR__ . "/globals.php";

global $host, $apiKey;

$client = new PQApiClient($host, $apiKey);
$client->setLanguage(Language::English());

$request = new GetSaleECODRequest(282658);
$response = $client->sendRequest($request);
$result = $request->formatData($response);

file_put_contents("ecod.xml", $result->content);

var_dump($result);
