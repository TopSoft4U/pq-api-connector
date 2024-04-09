<?php

namespace TopSoft4U\Connector\Methods\CreateSale;

use JsonSerializable;

class CreateSaleProduct implements JsonSerializable
{
    private int $id;
    private int $quantity;

    public function __construct(int $id, int $quantity)
    {
        $this->id = $id;
        $this->quantity = $quantity;
    }

    public function jsonSerialize(): array
    {
        return [
            "id" => $this->id,
            "qty" => $this->quantity,
        ];
    }
}
