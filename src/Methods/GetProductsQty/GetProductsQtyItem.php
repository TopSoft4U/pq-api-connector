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
        $result = new self();
        $result->id = $row["id"];
        $result->userPrice = $row["userprice"];
        $result->userPriceGross = $row["userpricegross"];
        $result->vatRate = $row["vatrate"];
        $result->qty = $row["qty"];

        return $result;
    }
}
