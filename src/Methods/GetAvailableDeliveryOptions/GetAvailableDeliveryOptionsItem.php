<?php
declare(strict_types=1);

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
    public float $maxSizeX;
    public float $maxSizeY;
    public float $maxSizeZ;
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

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $item = new self();
        $item->shipmentId = is_numeric($data["shipmentid"]) ? (int)$data["shipmentid"] : 0;
        $item->shipmentName = is_string($data["shipmentname"]) ? $data["shipmentname"] : "";
        $item->shipmentDescription = is_string($data["shipmentdescription"]) ? $data["shipmentdescription"] : null;

        $item->estimatedDeliveryTime = is_string($data["estimateddeliverytime"]) ? $data["estimateddeliverytime"] : null;

        $item->minPrice = is_numeric($data["minprice"]) ? (float)$data["minprice"] : 0.0;
        $item->maxPrice = is_numeric($data["maxprice"]) ? (float)$data["maxprice"] : 0.0;
        $item->maxLength = is_numeric($data["maxlength"]) ? (float)$data["maxlength"] : 0.0;
        $item->maxSizeX = is_numeric($data["maxsizex"]) ? (float)$data["maxsizex"] : 0.0;
        $item->maxSizeY = is_numeric($data["maxsizey"]) ? (float)$data["maxsizey"] : 0.0;
        $item->maxSizeZ = is_numeric($data["maxsizez"]) ? (float)$data["maxsizez"] : 0.0;
        $item->minCapacity = is_numeric($data["mincapacity"]) ? (float)$data["mincapacity"] : 0.0;
        $item->maxCapacity = is_numeric($data["maxcapacity"]) ? (float)$data["maxcapacity"] : 0.0;

        $item->tag = is_string($data["tag"]) ? $data["tag"] : "";

        $unix = $data["pickuphourunix"];
        if (is_numeric($unix)) {
            $dt = DateTime::createFromFormat('U', (string)$unix) ?: null;
            $item->pickupHour = $dt;
        }

        $item->available = (bool)$data["available"];
        $item->unavailableReason = is_string($data["unavailablereason"]) ? $data["unavailablereason"] : null;

        $item->price = is_numeric($data["pricenoformat"] ?? null) ? (float)$data["pricenoformat"] : null;
        $item->priceGross = is_numeric($data["pricegrossnoformat"] ?? null) ? (float)$data["pricegrossnoformat"] : null;
        $item->packagePriceGross = is_numeric($data["packagepricegrossnoformat"] ?? null) ? (float)$data["packagepricegrossnoformat"] : null;
        $item->packagePrice = is_numeric($data["packagepricenoformat"] ?? null) ? (float)$data["packagepricenoformat"] : null;

        $item->payments = [];
        $paymentList = $data["payment"];
        if (is_array($paymentList)) {
            foreach ($paymentList as $payment) {
                if (is_array($payment)) {
                    /** @var array<string, mixed> $payment */
                    $item->payments[] = GetAvailableDeliveryOptionsPayment::FromData($payment);
                }
            }
        }

        return $item;
    }
}
