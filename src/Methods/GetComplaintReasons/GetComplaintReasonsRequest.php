<?php

namespace TopSoft4U\Connector\Methods\GetComplaintReasons;

use TopSoft4U\Connector\Abstracts\GetMethod;
use TopSoft4U\Connector\Utils\DictionaryValue;

class GetComplaintReasonsRequest extends GetMethod
{
    public function getUrl(): string
    {
        return "/getComplaintReasons";
    }

    public function getQueryParams(): array
    {
        return [];
    }

    public function formatData($data): GetComplaintReasonsResponse
    {
        $response = new GetComplaintReasonsResponse();
        $response->items = [];
        foreach ($data as $item) {
            $response->items[] = new DictionaryValue($item["id"], $item["name"]);
        }
        return $response;
    }
}
