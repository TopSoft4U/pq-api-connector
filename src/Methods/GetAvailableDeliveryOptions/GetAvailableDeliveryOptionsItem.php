<?php

namespace TopSoft4U\Connector\Methods\GetAvailableDeliveryOptions;

use DateTime;

class GetAvailableDeliveryOptionsItem
{
    public int $shipmentId;
    public string $shipmentName;
    public ?string $shipmentDescription = null;

    public ?string $estimatedDeliveryTime = null;
    public float $minPrice;
    public float $maxPrice;
    public float $maxLength;
    public float $minCapacity;
    public float $maxCapacity;
    public string $tag;
    public ?DateTime $pickupHour = null;
    public bool $available;
    public ?string $unavailableReason = null;

    /**
     * Can be null $available = false
     *
     * @var float|null
     */
    public ?float $price = null;
    /**
     * Can be null $available = false
     *
     * @var float|null
     */
    public ?float $priceGross = null;
    /**
     * Can be null $available = false
     *
     * @var float|null
     */
    public ?float $packagePriceGross = null;
    /**
     * Can be null $available = false
     *
     * @var float|null
     */
    public ?float $packagePrice = null;

    /**
     * @var GetAvailableDeliveryOptionsPayment[]
     */
    public array $payments;

    public static function FromData(array $data): self
    {
        $item = new self();
        $item->shipmentId = $data["shipmentid"];
        $item->shipmentName = $data["shipmentname"];
        $item->shipmentDescription = $data["shipmentdescription"];

        $item->estimatedDeliveryTime = $data["estimateddeliverytime"];

        $item->minPrice = $data["minprice"];
        $item->maxPrice = $data["maxprice"];
        $item->maxLength = $data["maxlength"];
        $item->minCapacity = $data["mincapacity"];
        $item->maxCapacity = $data["maxcapacity"];

        $item->tag = $data["tag"];

        if ($data["pickuphourunix"])
            $item->pickupHour = DateTime::createFromFormat('U', $data["pickuphourunix"]);

        $item->available = $data["available"];
        $item->unavailableReason = $data["unavailablereason"];

        $item->price = $data["pricenoformat"] ?? null;
        $item->priceGross = $data["pricegrossnoformat"] ?? null;
        $item->packagePriceGross = $data["packagepricegrossnoformat"] ?? null;
        $item->packagePrice = $data["packagepricenoformat"] ?? null;

        $item->payments = [];
        foreach ($data["payment"] as $payment) {
            $item->payments[] = GetAvailableDeliveryOptionsPayment::FromData($payment);
        }

        return $item;
    }
}
