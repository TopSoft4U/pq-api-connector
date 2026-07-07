<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetProductsQty;

class GetProductsQtyItem
{
    public int $id;
    public float $userPrice;
    public float $userPriceGross;
    public ?string $currency = null;
    public float $vatRate;
    public float $qty;

    /**
     * @param array<string, mixed> $row
     */
    public static function FromData(array $row): self
    {
        $item = new self();
        $item->id = is_numeric($row["id"]) ? (int)$row["id"] : 0;
        $item->userPrice = is_numeric($row["userprice"]) ? (float)$row["userprice"] : 0.0;
        $item->userPriceGross = is_numeric($row["userpricegross"]) ? (float)$row["userpricegross"] : 0.0;
        $item->currency = is_string($row["currency"] ?? null) ? $row["currency"] : null;
        $item->vatRate = is_numeric($row["vatrate"]) ? (float)$row["vatrate"] : 0.0;
        $item->qty = is_numeric($row["qty"]) ? (float)$row["qty"] : 0.0;

        return $item;
    }
}
