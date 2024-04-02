<?php

namespace TopSoft4U\Connector\Methods\GetProductVariants;

use TopSoft4U\Connector\Abstracts\GetMethod;

class GetProductVariantsRequest extends GetMethod
{
    //region Query params
    private int $id;
    private int $categoryId;

    //endregion

    public function __construct(int $id, int $categoryId)
    {
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
            "XDEBUG_SESSION_START" => 1,
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
