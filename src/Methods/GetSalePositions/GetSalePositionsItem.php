<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetSalePositions;

class GetSalePositionsItem
{
    public int $positionId;
    public int $fkProduct;
    public float $qty;
    public ?string $pid = null;
    public ?string $ean = null;
    public int $type;
    public string $name;
    public float $price;
    public float $priceGross;
    public float $netPriceSum;
    public float $grossPriceSum;
    public float $rate;
    /** Processing time in days. @var int|null */
    public ?int $leadTime = null;

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $item = new self();
        $item->positionId = is_numeric($data['positionid']) ? (int)$data['positionid'] : 0;
        $item->fkProduct = is_numeric($data['fkproduct']) ? (int)$data['fkproduct'] : 0;
        $item->qty = is_numeric($data['qty']) ? (float)$data['qty'] : 0.0;
        $item->pid = is_string($data['pid']) ? $data['pid'] : null;
        $item->ean = is_string($data['ean']) ? $data['ean'] : null;
        $item->type = is_numeric($data['type']) ? (int)$data['type'] : 0;
        $item->name = is_string($data['name']) ? $data['name'] : "";
        $item->price = is_numeric($data['price']) ? (float)$data['price'] : 0.0;
        $item->priceGross = is_numeric($data['pricegross']) ? (float)$data['pricegross'] : 0.0;
        $item->netPriceSum = is_numeric($data['netpricesum']) ? (float)$data['netpricesum'] : 0.0;
        $item->grossPriceSum = is_numeric($data['grosspricesum']) ? (float)$data['grosspricesum'] : 0.0;
        $item->rate = is_numeric($data['rate']) ? (float)$data['rate'] : 0.0;
        $lt = $data['leadtime'] ?? null;
        $item->leadTime = is_numeric($lt) ? (int)$lt : null;

        return $item;
    }
}
