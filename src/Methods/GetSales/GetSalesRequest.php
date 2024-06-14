<?php

namespace TopSoft4U\Connector\Methods\GetSales;

use TopSoft4U\Connector\Abstracts\GetRequest;
use TopSoft4U\Connector\Utils\Date;

class GetSalesRequest extends GetRequest
{
    public ?array $id = null;
    public ?string $name = null;
    public ?string $invoiceName = null;
    public ?Date $date = null;
    public ?Date $modified = null;
    public ?array $type = null;
    public ?int $productId = null;
    public ?bool $isAttachable = null;

    public function getUrl(): string
    {
        return "/getSales";
    }

    public function getQueryParams(): array
    {
        $result = [];
        if ($this->id !== null)
            $result["id"] = $this->id;

        if ($this->name !== null)
            $result["name"] = $this->name;

        if ($this->invoiceName !== null)
            $result["invoicename"] = $this->invoiceName;

        if ($this->date !== null)
            $result["date"] = $this->date;

        if ($this->modified !== null)
            $result["modified"] = $this->modified;

        if ($this->type !== null)
            $result["type"] = $this->type;

        if ($this->productId !== null)
            $result["productid"] = $this->productId;

        if ($this->isAttachable !== null)
            $result["isattachable"] = $this->isAttachable;

        return $result;
    }

    public function formatData($data): GetSalesResponse
    {
        $result = new GetSalesResponse();
        foreach ($data as $row) {
            $result->items[] = GetSalesItem::FromData($row);
        }

        return $result;
    }
}
