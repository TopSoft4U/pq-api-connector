<?php

require_once __DIR__ . "/globals.php";

use TopSoft4U\Connector\Methods\GetComplaintTypeOptions\GetComplaintTypeOptionsRequest;
use TopSoft4U\Connector\PQApiClient;
use TopSoft4U\Connector\Utils\Language;

global $host, $apiKey;

$client = new PQApiClient($host, $apiKey);
$client->setLanguage(Language::English());

$request = new GetComplaintTypeOptionsRequest(419419, 0);
$request = new GetComplaintTypeOptionsRequest(419419, 12345);
$response = $client->sendRequest($request);
$result = $request->formatData($response);

var_dump($result);
