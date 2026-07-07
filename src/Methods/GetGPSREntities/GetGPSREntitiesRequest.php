<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetGPSREntities;

use TopSoft4U\Connector\Abstracts\PaginatedRequest;

class GetGPSREntitiesRequest extends PaginatedRequest
{
    //region Query params
    /** @var int[]|null */
    public ?array $id = null;
    //endregion

    public function getUrl(): string
    {
        return "/getGPSREntities";
    }

    protected function getOwnQueryParams(): array
    {
        $result = [];

        if ($this->id !== null)
            $result['id'] = $this->id;

        return $result;
    }

    public function formatData(array $data): GetGPSREntitiesResponse
    {
        $result = new GetGPSREntitiesResponse();
        foreach ($data as $row) {
            if (!is_array($row)) continue;
            /** @var array<string, mixed> $row */
            $result->items[] = GetGPSREntitiesItem::FromData($row);
        }

        return $result;
    }
}
