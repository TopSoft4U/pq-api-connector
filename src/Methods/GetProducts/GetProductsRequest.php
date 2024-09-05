<?php

namespace TopSoft4U\Connector\Methods\GetProducts;

use TopSoft4U\Connector\Abstracts\GetRequest;
use TopSoft4U\Connector\Utils\Currency;
use TopSoft4U\Connector\Utils\Date;

class GetProductsRequest extends GetRequest
{
    //region Query params
    public ?array $id = null;
    public ?string $name = null;
    public ?string $pid = null;
    public ?array $productCategoryId = null;
    public ?Date $modified = null;
    public ?Currency $currency = null;

    public ?bool $adult = null;
    public ?int $leadTime = null;
    //endregion

    public function getUrl(): string
    {
        return "/getProducts";
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

        if ($this->adult !== null)
            $result['adult'] = $this->adult;

        if ($this->leadTime !== null)
            $result['leadtime'] = $this->leadTime;

        return $result;
    }

    public function formatData($data): GetProductsResponse
    {
        $result = new GetProductsResponse();
        foreach ($data as $row) {
            $result->items[] = GetProductsItem::FromData($row);
        }

        return $result;
    }
}
