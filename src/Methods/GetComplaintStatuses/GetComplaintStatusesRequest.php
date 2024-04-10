<?php

namespace TopSoft4U\Connector\Methods\GetComplaintStatuses;

use TopSoft4U\Connector\Abstracts\GetRequest;
use TopSoft4U\Connector\Utils\DictionaryValue;

class GetComplaintStatusesRequest extends GetRequest
{
    public function getUrl(): string
    {
        return "/getComplaintStatuses";
    }

    public function getQueryParams(): array
    {
        return [];
    }

    public function formatData($data): GetComplaintStatusesResponse
    {
        $response = new GetComplaintStatusesResponse();
        $response->items = [];
        foreach ($data as $item) {
            $response->items[] = new DictionaryValue($item["id"], $item["name"]);
        }
        return $response;
    }
}
