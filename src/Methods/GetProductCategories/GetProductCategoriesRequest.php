<?php

namespace TopSoft4U\Connector\Methods\GetProductCategories;

use TopSoft4U\Connector\Abstracts\GetRequest;
use TopSoft4U\Connector\Utils\Date;

class GetProductCategoriesRequest extends GetRequest
{
    //region Query params
    public ?array $id = null;
    public ?int $fkParent = null;
    public ?Date $modified = null;
    public ?bool $adult = null;
    //endregion

    public function getUrl(): string
    {
        return "/getProductCategories";
    }

    public function getQueryParams(): array
    {
        $result = [];

        if ($this->id !== null)
            $result['id'] = $this->id;

        if ($this->fkParent !== null)
            $result['fkparent'] = $this->fkParent;

        if ($this->modified !== null)
            $result['modified'] = $this->modified;

        if ($this->adult !== null)
            $result['adult'] = $this->adult;

        return $result;
    }

    public function formatData($data): GetProductCategoriesResponse
    {
        $result = new GetProductCategoriesResponse();
        foreach ($data as $row) {
            $result->items[] = GetProductCategoryItem::FromData($row);
        }

        return $result;
    }
}
