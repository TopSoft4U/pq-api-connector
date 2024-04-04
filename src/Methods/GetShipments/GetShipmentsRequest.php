<?php

namespace TopSoft4U\Connector\Methods\GetShipments;

use TopSoft4U\Connector\Abstracts\GetMethod;
use TopSoft4U\Connector\Utils\Date;

class GetShipmentsRequest extends GetMethod
{
    //region Query params
    public ?array $id = null;
    public ?Date $created = null;
    public ?Date $modified = null;
    public ?Date $date = null;
    public ?string $name = null;
    public ?array $saleId = null;
    public ?array $shipmentTypeId = null;
    //endregion

    public function getUrl(): string
    {
        return "/getShipments";
    }

    public function getQueryParams(): array
    {
        $result = [];

        if ($this->id !== null)
            $result["id"] = $this->id;

        if ($this->created !== null)
            $result["created"] = $this->created;

        if ($this->modified !== null)
            $result["modified"] = $this->modified;

        if ($this->date !== null)
            $result["date"] = $this->date;

        if ($this->name !== null)
            $result["name"] = $this->name;

        if ($this->saleId !== null)
            $result["saleid"] = $this->saleId;

        if ($this->shipmentTypeId !== null)
            $result["shipmenttypeid"] = $this->shipmentTypeId;

        return $result;
    }

    public function formatData($data)
    {
        $result = new GetShipmentsResponse();
        foreach ($data as $row) {
            $result->items[] = GetShipmentsItem::FromData($row);
        }

        return $result;
    }
}
