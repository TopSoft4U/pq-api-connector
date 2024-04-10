<?php

require_once __DIR__ . "/globals.php";

use TopSoft4U\Connector\Methods\GetShipments\GetShipmentsRequest;
use TopSoft4U\Connector\PQApiClient;
use TopSoft4U\Connector\Utils\Date;
use TopSoft4U\Connector\Utils\Language;

global $host, $apiKey;

$client = new PQApiClient($host, $apiKey);
$client->setLanguage(Language::English());

$request = new GetShipmentsRequest();
$request->created = new Date("2021-01-01");
$request->shipmentTypeId = [64];

$response = $client->sendRequest($request);
$result = $request->formatData($response);

var_dump($result);
