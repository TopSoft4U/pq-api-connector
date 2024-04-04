<?php

namespace TopSoft4U\Connector\Methods\GetSales;

use TopSoft4U\Connector\Abstracts\GetMethod;
use TopSoft4U\Connector\Utils\Date;

class GetSalesRequest extends GetMethod
{
    public ?array $id = null;
    public ?string $name = null;
    public ?Date $date = null;
    public ?Date $modified = null;
    public ?array $type = null;

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

        if ($this->date !== null)
            $result["date"] = $this->date;

        if ($this->modified !== null)
            $result["modified"] = $this->modified;

        if ($this->type !== null)
            $result["type"] = $this->type;

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
