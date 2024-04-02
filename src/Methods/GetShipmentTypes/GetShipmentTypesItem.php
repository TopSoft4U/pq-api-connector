<?php

namespace TopSoft4U\Connector\Methods\GetShipmentTypes;

class GetShipmentTypesItem
{
    public int $id;
    public ?string $modified = null;
    public string $name;
    public ?string $description = null;
    public ?string $logo = null;
    public ?string $trackingUrl = null;
    public float $maxWeight;

    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = $data["id"];
        $item->modified = $data["modified"] ?: null;
        $item->name = $data["name"];
        $item->description = $data["description"] ?: null;
        $item->logo = $data["logo"] ?: null;
        $item->trackingUrl = $data["trackingurl"] ?: null;
        $item->maxWeight = $data["maxweight"];

        return $item;
    }
}
