<?php

namespace TopSoft4U\Connector\Methods\GetSale;

use TopSoft4U\Connector\Abstracts\GetMethod;

class GetSaleRequest extends GetMethod
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getUrl(): string
    {
        return "/getSale";
    }

    public function getQueryParams(): array
    {
        return [
            "id" => $this->id,
        ];
    }

    public function formatData($data): GetSaleResponse
    {
        return GetSaleResponse::FromData($data);
    }
}