<?php

namespace TopSoft4U\Connector\Methods\GetComplaintTypeOptions;

use TopSoft4U\Connector\Abstracts\GetMethod;

class GetComplaintTypeOptionsRequest extends GetMethod
{
    private int $saleId;
    private ?int $productId = null;

    public function __construct(int $saleId, ?int $productId = null)
    {
        $this->saleId = $saleId;
        $this->productId = $productId;
    }

    public function getUrl(): string
    {
        return "/getComplaintTypeOptions";
    }

    public function getQueryParams(): array
    {
        $result = [
            "saleid" => $this->saleId
        ];

        if ($this->productId !== null)
            $result["productid"] = $this->productId;

        return $result;
    }

    public function formatData($data)
    {
        $result = new GetComplaintTypeOptionsResponse();
        foreach ($data as $row) {
            $result->items[] = GetComplaintTypeOptionsItem::FromData($row);
        }

        return $result;
    }
}
