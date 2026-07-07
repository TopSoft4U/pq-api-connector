<?php
declare(strict_types=1);

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

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = is_numeric($data["id"]) ? (int)$data["id"] : 0;
        $mod = $data["modified"];
        $item->modified = is_string($mod) && $mod !== '' ? $mod : null;
        $item->name = is_string($data["name"]) ? $data["name"] : "";
        $desc = $data["description"];
        $item->description = is_string($desc) && $desc !== '' ? $desc : null;
        $logo = $data["logo"];
        $item->logo = is_string($logo) && $logo !== '' ? $logo : null;
        $tu = $data["trackingurl"];
        $item->trackingUrl = is_string($tu) && $tu !== '' ? $tu : null;
        $item->maxWeight = is_numeric($data["maxweight"]) ? (float)$data["maxweight"] : 0.0;

        return $item;
    }
}
