<?php

namespace TopSoft4U\Connector\Methods\GetProductsQty;

use TopSoft4U\Connector\Abstracts\GetRequest;
use TopSoft4U\Connector\Utils\Currency;
use TopSoft4U\Connector\Utils\Date;

class GetProductsQtyRequest extends GetRequest
{
    //region Query params
    public ?array $id = null;
    public ?string $name = null;
    public ?string $pid = null;
    public ?array $productCategoryId = null;
    public ?Date $modified = null;
    public ?Currency $currency = null;
    //endregion

    public function getUrl(): string
    {
        return "/getProductsQty";
    }

    public function getQueryParams(): array
    {
        $result = [];

        if ($this->id !== null)
            $result['id'] = $this->id;

        if ($this->name !== null)
            $result['name'] = $this->name;

        if ($this->pid !== null)
            $result['pid'] = $this->pid;

        if ($this->productCategoryId !== null)
            $result['productcategoryid'] = $this->productCategoryId;

        if ($this->modified !== null)
            $result['modified'] = $this->modified;

        if ($this->currency !== null)
            $result['currency'] = $this->currency;

        return $result;
    }

    public function formatData($data): GetProductsQtyResponse
    {
        $result = new GetProductsQtyResponse();
        foreach ($data as $row) {
            $result->items[] = GetProductsQtyItem::FromData($row);
        }

        return $result;
    }
}
