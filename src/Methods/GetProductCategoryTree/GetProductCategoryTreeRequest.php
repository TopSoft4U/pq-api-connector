<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetProductCategoryTree;

use TopSoft4U\Connector\Abstracts\GetRequest;

class GetProductCategoryTreeRequest extends GetRequest
{
    //region Query params
    public ?int $fkParent = null;
    //endregion

    public function getUrl(): string
    {
        return "/getProductCategoryTree";
    }

    public function getQueryParams(): array
    {
        $result = [];

        if ($this->fkParent !== null)
            $result['fkparent'] = $this->fkParent;

        return $result;
    }

    public function formatData(array $data): GetProductCategoryTreeResponse
    {
        $result = new GetProductCategoryTreeResponse();
        foreach ($data as $row) {
            if (!is_array($row)) continue;
            /** @var array<string, mixed> $row */
            $result->items[] = GetProductCategoryTreeItem::FromData($row);
        }

        return $result;
    }
}
