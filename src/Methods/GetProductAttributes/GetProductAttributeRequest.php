<?php

namespace TopSoft4U\Connector\Methods\GetProductAttributes;

use TopSoft4U\Connector\Abstracts\GetMethod;
use TopSoft4U\Connector\Utils\IdList;

class GetProductAttributeRequest extends GetMethod
{
    //region Query params
    public ?IdList $id = null;
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

    public function formatData($data): GetProductAttributeResponse
    {
        $result = new GetProductAttributeResponse();
        foreach ($data as $row) {
            $result->items[] = GetProductAttributeItem::FromData($row);
        }

        return $result;
    }
}
