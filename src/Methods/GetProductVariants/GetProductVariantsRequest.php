<?php

namespace TopSoft4U\Connector\Methods\GetProductVariants;

use TopSoft4U\Connector\Abstracts\GetRequest;

class GetProductVariantsRequest extends GetRequest
{
    //region Query params
    private int $id;
    private int $categoryId;

    //endregion

    public function __construct(int $id, int $categoryId)
    {
        if ($id <= 0)
            throw new \InvalidArgumentException("ID must be greater than 0");

        if ($categoryId <= 0)
            throw new \InvalidArgumentException("Category ID must be greater than 0");

        $this->id = $id;
        $this->categoryId = $categoryId;
    }

    public function getUrl(): string
    {
        return "/getProductVariants";
    }

    public function getQueryParams(): array
    {
        return [
            "id"         => $this->id,
            "categoryid" => $this->categoryId,
        ];
    }

    public function formatData($data): GetProductVariantsResponse
    {
        $result = new GetProductVariantsResponse();
        foreach ($data as $row) {
            $result->items[] = GetProductVariantItem::FromData($row);
        }

        return $result;
    }
}
