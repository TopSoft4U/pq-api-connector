<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetShipments;

use TopSoft4U\Connector\Abstracts\PaginatedRequest;
use TopSoft4U\Connector\Utils\Date;

class GetShipmentsRequest extends PaginatedRequest
{
    //region Query params
    /** @var int[]|null */
    public ?array $id = null;
    public ?Date $created = null;
    public ?Date $modified = null;
    public ?Date $date = null;
    public ?string $name = null;
    /** @var int[]|null */
    public ?array $saleId = null;
    /** @var int[]|null */
    public ?array $shipmentTypeId = null;
    //endregion

    public function getUrl(): string
    {
        return "/getShipments";
    }

    protected function getOwnQueryParams(): array
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

    public function formatData(array $data)
    {
        $result = new GetShipmentsResponse();
        foreach ($data as $row) {
            if (!is_array($row)) continue;
            /** @var array<string, mixed> $row */
            $result->items[] = GetShipmentsItem::FromData($row);
        }

        return $result;
    }
}
