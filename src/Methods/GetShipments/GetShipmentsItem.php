<?php
declare(strict_types=1);

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
    /** @var string[] */
    public array $orderDocumentNames = [];
    /** @var string[] */
    public array $orderNames = [];
    /** @var int[] */
    public array $orderIDs = [];
    public int $fkShipmentType;
    public ?string $shipmentTypeName = null;
    public ?string $trackingUrl = null;

    /**
     * @param mixed $value
     * @return string[]
     */
    private static function splitCsv($value): array
    {
        if (!is_string($value)) {
            return [];
        }
        $parts = explode(',', $value);
        return array_values(array_filter(array_map('trim', $parts), fn($v) => $v !== ''));
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = is_numeric($data["id"]) ? (int)$data["id"] : 0;
        $item->created = is_string($data["created"]) ? $data["created"] : null;
        $item->modified = is_string($data["modified"]) ? $data["modified"] : null;
        $item->date = is_string($data["date"]) ? $data["date"] : null;
        $name = $data["name"];
        $item->name = is_string($name) && $name !== '' ? $name : null;
        $item->state = is_numeric($data["state"]) ? (int)$data["state"] : 0;
        $item->weightGross = is_numeric($data["weightgross"]) ? (float)$data["weightgross"] : 0.0;
        $item->orderDocumentNames = self::splitCsv($data["orderdocumentnames"]);
        $item->orderNames = self::splitCsv($data["ordernames"]);
        $idsRaw = is_string($data["orderids"] ?? null) ? $data["orderids"] : '';
        /** @var int[] $ids */
        $ids = array_filter(array_map('intval', explode(',', $idsRaw)));
        $item->orderIDs = $ids;
        $item->fkShipmentType = is_numeric($data["fkshipmenttype"]) ? (int)$data["fkshipmenttype"] : 0;
        $stn = $data["shipmenttypename"];
        $item->shipmentTypeName = is_string($stn) && $stn !== '' ? $stn : null;
        $tu = $data["trackingurl"];
        $item->trackingUrl = is_string($tu) && $tu !== '' ? $tu : null;

        return $item;
    }
}
