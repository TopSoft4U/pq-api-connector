<?php

namespace TopSoft4U\Connector\Methods\GetShipments;

class GetShipmentsItem
{
    public int $id;
    public ?string $created = null;
    public ?string $modified = null;
    public ?string $date = null;
    public ?string $name = null;
    public int $state;
    public float $weightGross;
    public array $orderDocumentNames = [];
    public array $orderNames = [];
    public array $orderIDs = [];
    public int $fkShipmentType;
    public ?string $shipmentTypeName = null;
    public ?string $trackingUrl = null;

    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = $data["id"];
        $item->created = $data["created"];
        $item->modified = $data["modified"];
        $item->date = $data["date"];
        $item->name = $data["name"] ?: null;
        $item->state = $data["state"];
        $item->weightGross = $data["weightgross"];
        $item->orderDocumentNames = array_unique(array_filter(array_map('trim', explode(',', $data["orderdocumentnames"]))));
        $item->orderNames = array_unique(array_filter(array_map('trim', explode(',', $data["ordernames"]))));
        $item->orderIDs = array_unique(array_filter(array_map('intval', explode(',', $data["orderids"]))));
        $item->fkShipmentType = $data["fkshipmenttype"];
        $item->shipmentTypeName = $data["shipmenttypename"] ?: null;
        $item->trackingUrl = $data["trackingurl"] ?: null;

        return $item;
    }
}
