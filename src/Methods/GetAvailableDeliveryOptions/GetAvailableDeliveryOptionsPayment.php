<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetAvailableDeliveryOptions;

class GetAvailableDeliveryOptionsPayment
{
    public int $paymentId;
    public string $name;
    public ?string $description = null;
    public ?string $tag = null;
    public float $price;
    public float $priceGross;

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $item = new self();
        $item->paymentId = is_numeric($data["paymentid"]) ? (int)$data["paymentid"] : 0;
        $item->name = is_string($data["name"]) ? $data["name"] : "";
        $item->description = is_string($data["description"]) ? $data["description"] : null;
        $item->tag = is_string($data["tag"]) ? $data["tag"] : null;
        $item->price = is_numeric($data["pricenoformat"]) ? (float)$data["pricenoformat"] : 0.0;
        $item->priceGross = is_numeric($data["pricegrossnoformat"]) ? (float)$data["pricegrossnoformat"] : 0.0;

        return $item;
    }
}
