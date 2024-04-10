<?php

use TopSoft4U\Connector\Methods\GetSaleDocuments\GetSaleDocumentsRequest;
use TopSoft4U\Connector\PQApiClient;
use TopSoft4U\Connector\Utils\Language;

require_once __DIR__ . "/globals.php";

global $host, $apiKey;

$client = new PQApiClient($host, $apiKey);
$client->setLanguage(Language::English());

$request = new GetSaleDocumentsRequest(282658);
$response = $client->sendRequest($request);
$result = $request->formatData($response);

file_put_contents("tmp/{$result->items[0]->name}", $result->items[0]->getPayload());

var_dump($result);
