<?php
declare(strict_types=1);

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

    /**
     * @param array<string, mixed> $data
     */
    public function formatData(array $data): GetComplaintStatusesResponse
    {
        $response = new GetComplaintStatusesResponse();
        $response->items = [];
        foreach ($data as $item) {
            if (!is_array($item)) continue;
            /** @var array<string, mixed> $item */
            $response->items[] = new DictionaryValue(
                is_numeric($item["id"]) ? (int)$item["id"] : 0,
                is_string($item["name"]) ? $item["name"] : ""
            );
        }
        return $response;
    }
}
