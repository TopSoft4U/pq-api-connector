<?php

namespace TopSoft4U\Connector\Methods\GetProductsQty;

class GetProductsQtyItem
{
    public int $id;
    public float $userPrice;
    public float $userPriceGross;
    public float $vatRate;
    public float $qty;

    public static function FromData(array $row): self
    {
        $item = new self();
        $item->id = $row["id"];
        $item->userPrice = $row["userprice"];
        $item->userPriceGross = $row["userpricegross"];
        $item->vatRate = $row["vatrate"];
        $item->qty = $row["qty"];

        return $item;
    }
}
