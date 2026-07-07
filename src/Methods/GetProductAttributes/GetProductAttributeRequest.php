<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetProductAttributes;

use TopSoft4U\Connector\Abstracts\GetRequest;

class GetProductAttributeRequest extends GetRequest
{
    //region Query params
    /** @var int[]|null */
    public ?array $id = null;
    public ?int $categoryId = null;

    //endregion

    public function getUrl(): string
    {
        return "/getProductAttributes";
    }

    public function getQueryParams(): array
    {
        $result = [];

        if ($this->id !== null)
            $result['id'] = $this->id;

        if ($this->categoryId !== null)
            $result['categoryid'] = $this->categoryId;

        return $result;
    }

    public function formatData(array $data): GetProductAttributeResponse
    {
        $result = new GetProductAttributeResponse();
        foreach ($data as $row) {
            if (!is_array($row)) continue;
            /** @var array<string, mixed> $row */
            $result->items[] = GetProductAttributeItem::FromData($row);
        }

        return $result;
    }
}
