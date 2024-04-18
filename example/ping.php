<?php

use TopSoft4U\Connector\Methods\Ping\PingRequest;
use TopSoft4U\Connector\PQApiClient;

require_once __DIR__ . "/globals.php";

global $host, $apiKey;

$client = new PQApiClient($host, $apiKey);

$request = new PingRequest();
$client->sendRequest($request);
// No response, because 204 No Content is expected, will throw exception if there is a server error/maintenance going on.

