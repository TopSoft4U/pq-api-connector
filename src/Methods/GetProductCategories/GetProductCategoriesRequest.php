<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetProductCategories;

use TopSoft4U\Connector\Abstracts\PaginatedRequest;
use TopSoft4U\Connector\Utils\Date;

class GetProductCategoriesRequest extends PaginatedRequest
{
    //region Query params
    /** @var int[]|null */
    public ?array $id = null;
    public ?int $fkParent = null;
    public ?Date $modified = null;
    public ?bool $adult = null;
    //endregion

    public function getUrl(): string
    {
        return "/getProductCategories";
    }

    protected function getOwnQueryParams(): array
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

    public function formatData(array $data): GetProductCategoriesResponse
    {
        $result = new GetProductCategoriesResponse();
        foreach ($data as $row) {
            if (!is_array($row)) continue;
            /** @var array<string, mixed> $row */
            $result->items[] = GetProductCategoryItem::FromData($row);
        }

        return $result;
    }
}
