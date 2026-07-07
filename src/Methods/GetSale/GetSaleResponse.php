<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetSale;

class GetSaleResponse
{
    public int $id;
    public int $type;
    public ?string $created = null;
    public ?string $dateCancel = null;
    public ?string $modified = null;
    public ?string $invoiceName = null;
    public ?string $orderName = null;
    public int $fkSale;
    public ?string $correctedName = null;
    public int $fkSaleNonRating;
    public ?string $nonRatingName = null;
    public ?string $correctionName = null;

    public string $symbol;
    public int $fkCurrency;

    public int $shipmentID;
    public string $shipmentName;
    public ?int $pickupPointID = null;

    public int $paymentID;
    public string $paymentName;
    public ?string $paymentDescription = null;
    public string $paymentTag;

    public ?string $receiverName = null;
    public ?string $postalCode = null;
    public ?string $city = null;
    public ?string $street = null;
    public ?string $bno = null;
    public ?string $lno = null;

    public int $fkCountry;
    public string $countryName;
    public string $iso;

    public float $weight;
    public float $weightGross;

    public ?string $notice = null;
    public int $paydays;
    public int $fkContractor;

    public ?string $contractorName = null;
    public ?string $contractorPostalCode = null;
    public ?string $contractorCity = null;
    public ?string $contractorStreet = null;
    public ?string $contractorBuildingNo = null;
    public ?string $contractorFlatNo = null;
    public int $contractorFKCountry;
    public string $contractorCountryName;
    public string $contractorCountryIso;

    public ?string $phone = null;
    public ?string $email = null;
    public float $paid;
    public string $paymentDeadline;

    public bool $isPaid;
    public bool $isPacked;
    public bool $isShipped;
    public bool $isAssembling;

    /**
     * @var int[]
     */
    public array $mergedIDs = [];
    public int $leadTime;

    public float $productPrice;
    public float $productPriceGross;
    public float $packagePrice;
    public float $packagePriceGross;
    public float $paymentPrice;
    public float $paymentPriceGross;
    public float $shipmentPrice;
    public float $shipmentPriceGross;
    public float $total;
    public float $totalGross;

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = is_numeric($data["id"]) ? (int)$data["id"] : 0;
        $item->type = is_numeric($data["type"]) ? (int)$data["type"] : 0;
        $item->created = is_string($data["created"]) ? $data["created"] : null;
        $item->dateCancel = is_string($data["datecancel"]) ? $data["datecancel"] : null;
        $item->modified = is_string($data["modified"]) ? $data["modified"] : null;
        $item->invoiceName = is_string($data["invoicename"]) ? $data["invoicename"] : null;
        $item->orderName = is_string($data["ordername"]) ? $data["ordername"] : null;
        $item->fkSale = is_numeric($data["fksale"]) ? (int)$data["fksale"] : 0;
        $item->correctedName = is_string($data["correctedname"]) ? $data["correctedname"] : null;
        $item->fkSaleNonRating = is_numeric($data["fksalenonrating"]) ? (int)$data["fksalenonrating"] : 0;
        $item->nonRatingName = is_string($data["nonratingname"]) ? $data["nonratingname"] : null;
        $item->correctionName = is_string($data["correctionname"]) ? $data["correctionname"] : null;
        $item->symbol = is_string($data["symbol"]) ? $data["symbol"] : "";
        $item->fkCurrency = is_numeric($data["fkcurrency"]) ? (int)$data["fkcurrency"] : 0;
        $item->shipmentID = is_numeric($data["shipmentid"]) ? (int)$data["shipmentid"] : 0;
        $item->shipmentName = is_string($data["shipmentname"]) ? $data["shipmentname"] : "";
        $item->pickupPointID = is_numeric($data["pickuppointid"]) ? (int)$data["pickuppointid"] : null;
        $item->paymentID = is_numeric($data["paymentid"]) ? (int)$data["paymentid"] : 0;
        $item->paymentName = is_string($data["paymentname"]) ? $data["paymentname"] : "";
        $item->paymentDescription = is_string($data["paymentdescription"]) ? $data["paymentdescription"] : null;
        $item->paymentTag = is_string($data["paymenttag"]) ? $data["paymenttag"] : "";
        $item->receiverName = is_string($data["receivername"]) ? $data["receivername"] : null;
        $item->postalCode = is_string($data["postalcode"]) ? $data["postalcode"] : null;
        $item->city = is_string($data["city"]) ? $data["city"] : null;
        $item->street = is_string($data["street"]) ? $data["street"] : null;
        $item->bno = is_string($data["bno"]) ? $data["bno"] : null;
        $item->lno = is_string($data["lno"]) ? $data["lno"] : null;
        $item->fkCountry = is_numeric($data["fkcountry"]) ? (int)$data["fkcountry"] : 0;
        $item->countryName = is_string($data["countryname"]) ? $data["countryname"] : "";
        $item->iso = is_string($data["iso"]) ? $data["iso"] : "";
        $item->weight = is_numeric($data["weight"]) ? (float)$data["weight"] : 0.0;
        $item->weightGross = is_numeric($data["weightgross"]) ? (float)$data["weightgross"] : 0.0;
        $item->notice = is_string($data["notice"]) ? $data["notice"] : null;
        $item->paydays = is_numeric($data["paydays"]) ? (int)$data["paydays"] : 0;
        $item->fkContractor = is_numeric($data["fkcontractor"]) ? (int)$data["fkcontractor"] : 0;

        $item->contractorName = is_string($data["contractorname"]) ? $data["contractorname"] : null;
        $item->contractorPostalCode = is_string($data["contractorpostalcode"]) ? $data["contractorpostalcode"] : null;
        $item->contractorCity = is_string($data["contractorcity"]) ? $data["contractorcity"] : null;
        $item->contractorStreet = is_string($data["contractorstreet"]) ? $data["contractorstreet"] : null;
        $item->contractorBuildingNo = is_string($data["contractorbuildingno"]) ? $data["contractorbuildingno"] : null;
        $item->contractorFlatNo = is_string($data["contractorflatno"]) ? $data["contractorflatno"] : null;
        $item->contractorFKCountry = is_numeric($data["contractorfkcountry"]) ? (int)$data["contractorfkcountry"] : 0;
        $item->contractorCountryName = is_string($data["contractorcountryname"]) ? $data["contractorcountryname"] : "";
        $item->contractorCountryIso = is_string($data["contractorcountryiso"]) ? $data["contractorcountryiso"] : "";

        $item->phone = is_string($data["phone"]) ? $data["phone"] : null;
        $item->email = is_string($data["email"] ?? null) ? $data["email"] : null;
        $item->paid = is_numeric($data["paid"]) ? (float)$data["paid"] : 0.0;
        $item->paymentDeadline = is_string($data["paymentdeadline"]) ? $data["paymentdeadline"] : "";
        $item->isPaid = (bool)$data["ispaid"];
        $item->isPacked = (bool)$data["ispacked"];
        $item->isShipped = (bool)$data["isshipped"];
        $mergedRaw = $data['mergedids'];
        $mergedStr = is_string($mergedRaw) ? $mergedRaw : '';
        /** @var int[] $mergedIds */
        $mergedIds = array_filter(array_map('intval', explode(',', $mergedStr)));
        $item->mergedIDs = $mergedIds;
        $item->isAssembling = (bool)$data["isassembling"];
        $item->leadTime = is_numeric($data["leadtime"]) ? (int)$data["leadtime"] : 0;

        $item->productPrice = is_numeric($data["productprice"]) ? (float)$data["productprice"] : 0.0;
        $item->productPriceGross = is_numeric($data["productpricegross"]) ? (float)$data["productpricegross"] : 0.0;
        $item->packagePrice = is_numeric($data["packageprice"]) ? (float)$data["packageprice"] : 0.0;
        $item->packagePriceGross = is_numeric($data["packagepricegross"]) ? (float)$data["packagepricegross"] : 0.0;
        $item->paymentPrice = is_numeric($data["paymentprice"]) ? (float)$data["paymentprice"] : 0.0;
        $item->paymentPriceGross = is_numeric($data["paymentpricegross"]) ? (float)$data["paymentpricegross"] : 0.0;
        $item->shipmentPrice = is_numeric($data["shipmentprice"]) ? (float)$data["shipmentprice"] : 0.0;
        $item->shipmentPriceGross = is_numeric($data["shipmentpricegross"]) ? (float)$data["shipmentpricegross"] : 0.0;
        $item->total = is_numeric($data["total"]) ? (float)$data["total"] : 0.0;
        $item->totalGross = is_numeric($data["totalgross"]) ? (float)$data["totalgross"] : 0.0;

        return $item;
    }
}
