<?php

namespace TopSoft4U\Connector\Methods\GetSalePositions;

use TopSoft4U\Connector\Abstracts\GetMethod;

class GetSalePositionsRequest extends GetMethod
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getUrl(): string
    {
        return "/getSalePositions";
    }

    public function getQueryParams(): array
    {
        return [
            "id" => $this->id,
        ];
    }

    public function formatData($data): GetSalePositionsResponse
    {
        $result = new GetSalePositionsResponse();
        foreach ($data as $row) {
            $result->items[] = GetSalePositionsItem::FromData($row);
        }

        return $result;
    }
}
