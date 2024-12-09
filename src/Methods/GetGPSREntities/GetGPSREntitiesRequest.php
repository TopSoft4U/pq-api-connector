<?php

namespace TopSoft4U\Connector\Methods\GetGPSREntities;

use TopSoft4U\Connector\Abstracts\GetRequest;

class GetGPSREntitiesRequest extends GetRequest
{
    //region Query params
    public ?array $id = null;
    //endregion

    public function getUrl(): string
    {
        return "/getGPSREntities";
    }

    public function getQueryParams(): array
    {
        $result = [];

        if ($this->id !== null)
            $result['id'] = $this->id;

        return $result;
    }

    public function formatData($data): GetGPSREntitiesResponse
    {
        $result = new GetGPSREntitiesResponse();
        foreach ($data as $row) {
            $result->items[] = GetGPSREntitiesItem::FromData($row);
        }

        return $result;
    }
}
