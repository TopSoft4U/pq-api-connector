<?php

namespace TopSoft4U\Connector\Methods\GetSaleDocuments;

use TopSoft4U\Connector\Abstracts\GetMethod;
use TopSoft4U\Connector\Utils\Date;
use TopSoft4U\Connector\Utils\IdList;

class GetSaleDocumentsRequest extends GetMethod
{
    private int $id;
    public ?Date $date = null;
    public ?IdList $type = null;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getUrl(): string
    {
        return "/getSaleDocuments";
    }

    public function getQueryParams(): array
    {
        $result = [
            "id" => $this->id,
        ];

        if ($this->date !== null)
            $result["date"] = $this->date;

        if ($this->type !== null)
            $result["type"] = $this->type;

        return $result;
    }

    public function formatData($data)
    {
        $result = new GetSaleDocumentsResponse();
        foreach ($data as $row) {
            $result->items[] = GetSaleDocumentsItem::FromData($row);
        }

        return $result;
    }
}