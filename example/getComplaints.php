<?php

require_once __DIR__ . "/globals.php";

use TopSoft4U\Connector\Methods\GetComplaints\GetComplaintsRequest;
use TopSoft4U\Connector\PQApiClient;
use TopSoft4U\Connector\Utils\Date;
use TopSoft4U\Connector\Utils\Language;

global $host, $apiKey;

$client = new PQApiClient($host, $apiKey);
$client->setLanguage(Language::English());

$request = new GetComplaintsRequest();
$request->modified = new Date("2021-01-01");
$request->complaintStatusId = [1];
$request->complaintReasonId = [4];

$response = $client->sendRequest($request);
$result = $request->formatData($response);

var_dump($result);
