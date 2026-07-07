<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetCategoryAttributes;

use TopSoft4U\Connector\Abstracts\PaginatedRequest;
use TopSoft4U\Connector\Utils\Date;

class GetCategoryAttributesRequest extends PaginatedRequest
{
    //region Query params
    /** @var int[]|null */
    public ?array $id = null;
    /** @var int[]|null */
    public ?array $categoryId = null;
    public ?string $name = null;
    public ?Date $modified = null;
    public ?GetCategoryAttributeType $type = null;
    //endregion

    public function getUrl(): string
    {
        return "/getCategoryAttributes";
    }

    protected function getOwnQueryParams(): array
    {
        $result = [];

        if ($this->id !== null)
            $result['id'] = $this->id;

        if ($this->categoryId !== null)
            $result['categoryid'] = $this->categoryId;

        if ($this->name !== null)
            $result['name'] = $this->name;

        if ($this->modified !== null)
            $result['modified'] = $this->modified;

        if ($this->type !== null)
            $result['type'] = $this->type;

        return $result;
    }

    public function formatData(array $data): GetCategoryAttributesResponse
    {
        $result = new GetCategoryAttributesResponse();
        foreach ($data as $row) {
            if (!is_array($row)) continue;
            /** @var array<string, mixed> $row */
            $result->items[] = GetCategoryAttributesItem::FromData($row);
        }

        return $result;
    }
}
