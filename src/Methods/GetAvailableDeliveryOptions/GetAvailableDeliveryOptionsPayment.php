<?php

namespace TopSoft4U\Connector\Methods\GetAvailableDeliveryOptions;

class GetAvailableDeliveryOptionsPayment
{
    public int $paymentId;
    public string $name;
    public ?string $description = null;
    public ?string $tag = null;
    public float $price;
    public float $priceGross;
    public ?string $priceExplanation;

    public static function FromData(array $data): self
    {
        $item = new self();
        $item->paymentId = $data["paymentid"];
        $item->name = $data["name"];
        $item->description = $data["description"];
        $item->tag = $data["tag"];
        $item->price = $data["pricenoformat"];
        $item->priceGross = $data["pricegrossnoformat"];
        $item->priceExplanation = $data["priceexplanation"];

        return $item;
    }
}
