<?php

namespace TopSoft4U\Connector\Methods\GetProducts;

use TopSoft4U\Connector\Utils\DictionaryValue;

class GetProductsItem
{
    public int $id;
    public ?string $modified;
    public string $name;
    public ?string $pid = null;
    public ?string $ean = null;
    public int $status;
    public bool $allowPriceOffer;
    public bool $askForPrice;
    public int $fkOutletAncestor;
    public ?string $defect = null;
    public ?int $incomingDays = null;
    public ?string $description = null;

    public float $userPrice;
    public float $userPriceGross;
    public float $vatRate;

    public float $supplyQty;
    public float $qty;

    public bool $eol;
    public bool $forAdults;

    /**
     * In cm
     * @var float
     */
    public float $sizeX;
    /**
     * In cm
     * @var float
     */
    public float $sizeY;
    /**
     * In cm
     * @var float
     */
    public float $sizeZ;

    public int $leadTime;

    public ?DictionaryValue $productCondition = null;
    public ?DictionaryValue $productUnit = null;
    public ?DictionaryValue $productGroup = null;

    public int $producerId;
    public int $responsibleCompanyId;
    public ?string $safetyInformation = null;

    /**
     * In kg
     * @var float
     */
    public float $weight;
    /**
     * In kg (with packaging)
     * @var float
     */
    public float $weightGross;

    public ?string $cnCode = null;

    /**
     * @var int[]
     */
    public array $categories;

    /**
     * @var string[]
     */
    public array $images;

    public static function FromData(array $row): self
    {
        $item = new self();
        $item->id = $row["id"];
        $item->modified = $row["modified"];
        $item->name = $row["name"];
        $item->pid = $row["pid"];
        $item->ean = $row["ean"];
        $item->status = $row["status"];
        $item->allowPriceOffer = $row["allowpriceoffer"];
        $item->askForPrice = $row["askforprice"];
        $item->fkOutletAncestor = $row["fkoutletancestor"];
        $item->defect = $row["defect"];
        $item->incomingDays = $row["incomingdays"];
        $item->description = $row["description"];
        $item->userPrice = $row["userprice"];
        $item->userPriceGross = $row["userpricegross"];
        $item->vatRate = $row["vatrate"];
        $item->supplyQty = $row["supplyqty"];
        $item->qty = $row["qty"];
        $item->eol = $row["eol"];
        $item->forAdults = $row["foradults"];
        $item->sizeX = $row["size_x"];
        $item->sizeY = $row["size_y"];
        $item->sizeZ = $row["size_z"];
        $item->leadTime = $row["leadtime"];
        $item->productCondition = $row["productconditionid"] ? new DictionaryValue($row["productconditionid"], $row["productconditionname"]) : null;
        $item->productUnit = $row["productunitid"] ? new DictionaryValue($row["productunitid"], $row["productunitname"]) : null;
        $item->productGroup = $row["productgroupid"] ? new DictionaryValue($row["productgroupid"], $row["productgroupname"]) : null;
        $item->weight = $row["weight"];
        $item->weightGross = $row["weightgross"];
        $item->cnCode = $row["cncode"];
        $item->categories = $row["categories"];
        $item->images = $row["images"];

        $item->producerId = $row["producerid"];
        $item->responsibleCompanyId = $row["responsiblecompanyid"];
        $item->safetyInformation = $row["safetyinformation"];

        return $item;
    }
}
