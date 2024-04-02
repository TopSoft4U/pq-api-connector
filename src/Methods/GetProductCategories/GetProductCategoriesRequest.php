<?php

namespace TopSoft4U\Connector\Methods\GetProductCategories;

use TopSoft4U\Connector\Abstracts\GetMethod;
use TopSoft4U\Connector\Utils\IdList;

class GetProductCategoriesRequest extends GetMethod
{
    //region Query params
    public ?IdList $id = null;
    public ?int $fkParent = null;
    public ?string $modified = null;
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

        if ($this->modified !== null) {
            // Validate format yyyy-MM-dd
            $date = \DateTime::createFromFormat('Y-m-d', $this->modified);
            if ($date === false)
                throw new \Exception("Invalid date format - expected yyyy-MM-dd");

            $result['modified'] = $this->modified;
        }

        if ($this->adult !== null)
            $result['adult'] = $this->adult;

        return $result;
    }

    public function formatData($data): GetProductCategoryTreeResponse
    {
        $result = new GetProductCategoryTreeResponse();
        foreach ($data as $row) {
            $result->items[] = GetProductCategoryTreeItem::FromData($row);
        }

        return $result;
    }
}
