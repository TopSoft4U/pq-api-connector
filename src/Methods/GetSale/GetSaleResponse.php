<?php

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
    public float $paid;
    public string $paymentDeadline;

    public bool $isPaid;
    public bool $isPacked;
    public bool $isShipped;
    public bool $isAssembling;

    public array $mergedIDs = [];
    public int $leadTime;

    public float $productPrice;
    public float $productPriceGross;
    public float $packagePrice;
    public float $packagePriceGross;
    public float $paymentPrice;
    public float $paymentPriceGross;
    public float $shipmentCountry;
    public float $shipmentPriceGross;
    public float $total;
    public float $totalGross;

    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = $data["id"];
        $item->type = $data["type"];
        $item->created = $data["created"];
        $item->dateCancel = $data["datecancel"];
        $item->modified = $data["modified"];
        $item->invoiceName = $data["invoicename"];
        $item->orderName = $data["ordername"];
        $item->fkSale = $data["fksale"];
        $item->correctedName = $data["correctedname"];
        $item->fkSaleNonRating = $data["fksalenonrating"];
        $item->nonRatingName = $data["nonratingname"];
        $item->correctionName = $data["correctionname"];
        $item->symbol = $data["symbol"];
        $item->fkCurrency = $data["fkcurrency"];
        $item->shipmentID = $data["shipmentid"];
        $item->shipmentName = $data["shipmentname"];
        $item->pickupPointID = $data["pickuppointid"];
        $item->paymentID = $data["paymentid"];
        $item->paymentName = $data["paymentname"];
        $item->paymentDescription = $data["paymentdescription"];
        $item->paymentTag = $data["paymenttag"];
        $item->receiverName = $data["receivername"];
        $item->postalCode = $data["postalcode"];
        $item->city = $data["city"];
        $item->street = $data["street"];
        $item->bno = $data["bno"];
        $item->lno = $data["lno"];
        $item->fkCountry = $data["fkcountry"];
        $item->countryName = $data["countryname"];
        $item->iso = $data["iso"];
        $item->weight = $data["weight"];
        $item->weightGross = $data["weightgross"];
        $item->notice = $data["notice"];
        $item->paydays = $data["paydays"];
        $item->fkContractor = $data["fkcontractor"];

        $item->contractorName = $data["contractorname"];
        $item->contractorPostalCode = $data["contractorpostalcode"];
        $item->contractorCity = $data["contractorcity"];
        $item->contractorStreet = $data["contractorstreet"];
        $item->contractorBuildingNo = $data["contractorbuildingno"];
        $item->contractorFlatNo = $data["contractorflatno"];
        $item->contractorFKCountry = $data["contractorfkcountry"];
        $item->contractorCountryName = $data["contractorcountryname"];
        $item->contractorCountryIso = $data["contractorcountryiso"];

        $item->phone = $data["phone"];
        $item->paid = $data["paid"];
        $item->paymentDeadline = $data["paymentdeadline"];
        $item->isPaid = $data["ispaid"];
        $item->isPacked = $data["ispacked"];
        $item->isShipped = $data["isshipped"];
        $item->mergedIDs = array_filter(array_map('intval', explode(',', $data['mergedids'])));
        $item->isAssembling = $data["isassembling"];
        $item->leadTime = $data["leadtime"];

        $item->productPrice = $data["productprice"];
        $item->productPriceGross = $data["productpricegross"];
        $item->packagePrice = $data["packageprice"];
        $item->packagePriceGross = $data["packagepricegross"];
        $item->paymentPrice = $data["paymentprice"];
        $item->paymentPriceGross = $data["paymentpricegross"];
        $item->shipmentCountry = $data["shipmentprice"];
        $item->shipmentPriceGross = $data["shipmentpricegross"];
        $item->total = $data["total"];
        $item->totalGross = $data["totalgross"];

        return $item;
    }
}
