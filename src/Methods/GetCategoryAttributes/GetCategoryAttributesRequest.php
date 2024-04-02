<?php

namespace TopSoft4U\Connector\Methods\GetCategoryAttributes;

use TopSoft4U\Connector\Abstracts\GetMethod;
use TopSoft4U\Connector\Utils\IdList;

class GetCategoryAttributesRequest extends GetMethod
{
    //region Query params
    public ?IdList $id = null;
    public ?IdList $categoryId = null;
    public ?string $name = null;
    public ?string $modified = null;
    public ?GetCategoryAttributeType $type = null;

    //endregion

    public function getUrl(): string
    {
        return "/getCategoryAttributes";
    }

    public function getQueryParams(): array
    {
        $result = [];

        if ($this->id !== null)
            $result['id'] = $this->id;

        if ($this->categoryId !== null)
            $result['categoryid'] = $this->categoryId;

        if ($this->name !== null)
            $result['name'] = $this->name;

        if ($this->modified !== null) {
            // Validate format yyyy-MM-dd
            $date = \DateTime::createFromFormat('Y-m-d', $this->modified);
            if ($date === false)
                throw new \Exception("Invalid date format - expected yyyy-MM-dd");

            $result['modified'] = $this->modified;
        }

        if ($this->type !== null)
            $result['type'] = $this->type;

        return $result;
    }

    public function formatData($data): GetCategoryAttributesResponse
    {
        $result = new GetCategoryAttributesResponse();
        foreach ($data as $row) {
            $result->items[] = GetCategoryAttributesItem::FromData($row);
        }

        return $result;
    }
}
