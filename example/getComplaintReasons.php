<?php

require_once __DIR__ . "/globals.php";

use TopSoft4U\Connector\Methods\GetComplaintReasons\GetComplaintReasonsRequest;
use TopSoft4U\Connector\PQApiClient;
use TopSoft4U\Connector\Utils\Language;

global $host, $apiKey;

$client = new PQApiClient($host, $apiKey);
$client->setLanguage(Language::English());

$request = new GetComplaintReasonsRequest();
$response = $client->sendRequest($request);
$result = $request->formatData($response);

var_dump($result);
