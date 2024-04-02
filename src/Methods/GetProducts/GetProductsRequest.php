<?php

namespace TopSoft4U\Connector\Methods\GetProducts;

use TopSoft4U\Connector\Abstracts\BaseMethod;
use TopSoft4U\Connector\Abstracts\GetMethod;
use TopSoft4U\Connector\Utils\Currency;
use TopSoft4U\Connector\Utils\IdList;

class GetProductsRequest extends GetMethod
{
    //region Query params
    public ?IdList $id = null;
    public ?string $name = null;
    public ?string $pid = null;
    public ?IdList $productCategoryId = null;
    public ?string $modified = null;
    public ?Currency $currency = null;
    public ?string $fit1 = null;
    public ?string $fit2 = null;
    public ?string $fit3 = null;

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

        if ($this->modified !== null) {
            // Validate format yyyy-MM-dd
            $date = \DateTime::createFromFormat('Y-m-d', $this->modified);
            if ($date === false)
                throw new \Exception("Invalid date format - expected yyyy-MM-dd");

            $result['modified'] = $this->modified;
        }

        if ($this->currency !== null)
            $result['currency'] = $this->currency;

        if ($this->fit1 !== null)
            $result['fit1'] = $this->fit1;

        if ($this->fit2 !== null)
            $result['fit2'] = $this->fit2;

        if ($this->fit3 !== null)
            $result['fit3'] = $this->fit3;

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
