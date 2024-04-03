<?php

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
    public ?string $leadTime = null;

    public static function FromData(array $data): self
    {
        $item = new self();
        $item->positionId = $data['positionid'];
        $item->fkProduct = $data['fkproduct'];
        $item->qty = $data['qty'];
        $item->pid = $data['pid'];
        $item->ean = $data['ean'];
        $item->type = $data['type'];
        $item->name = $data['name'];
        $item->price = $data['price'];
        $item->priceGross = $data['pricegross'];
        $item->netPriceSum = $data['netpricesum'];
        $item->grossPriceSum = $data['grosspricesum'];
        $item->rate = $data['rate'];
        $item->leadTime = $data['leadtime'];

        return $item;
    }
}
