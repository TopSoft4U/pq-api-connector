<?php

namespace TopSoft4U\Connector\Methods\GetComplaintTypeOptions;

use TopSoft4U\Connector\Abstracts\GetRequest;

class GetComplaintTypeOptionsRequest extends GetRequest
{
    private int $saleId;
    private ?int $productId = null;

    public function __construct(int $saleId, int $productId)
    {
        if ($saleId <= 0)
            throw new \InvalidArgumentException("Sale ID must be greater than 0");

        if ($productId < 0)
            throw new \InvalidArgumentException("Product ID must be greater than to 0. If you want get options for whole sale - set it to 0");

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
