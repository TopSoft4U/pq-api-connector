<?php

namespace TopSoft4U\Connector\Methods\GetSaleECOD;

use TopSoft4U\Connector\Abstracts\GetRequest;

class GetSaleECODRequest extends GetRequest
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getUrl(): string
    {
        return "/getSaleECOD";
    }

    public function getQueryParams(): array
    {
        return [
            "id" => $this->id
        ];
    }

    public function formatData($data): GetSaleECODResponse
    {
        return GetSaleECODResponse::FromData($data);
    }
}
