<?php

namespace TopSoft4U\Connector\Methods\GetProducts;

use TopSoft4U\Connector\Utils\DictionaryValue;

class GetProductsItem
{
    public int $id;
    public string $modified;
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
        $result = new self();
        $result->id = $row["id"];
        $result->modified = $row["modified"];
        $result->name = $row["name"];
        $result->pid = $row["pid"];
        $result->ean = $row["ean"];
        $result->status = $row["status"];
        $result->allowPriceOffer = $row["allowpriceoffer"];
        $result->askForPrice = $row["askforprice"];
        $result->fkOutletAncestor = $row["fkoutletancestor"];
        $result->defect = $row["defect"];
        $result->incomingDays = $row["incomingdays"];
        $result->description = $row["description"];
        $result->userPrice = $row["userprice"];
        $result->userPriceGross = $row["userpricegross"];
        $result->vatRate = $row["vatrate"];
        $result->supplyQty = $row["supplyqty"];
        $result->qty = $row["qty"];
        $result->eol = $row["eol"];
        $result->forAdults = $row["foradults"];
        $result->sizeX = $row["size_x"];
        $result->sizeY = $row["size_y"];
        $result->sizeZ = $row["size_z"];
        $result->leadTime = $row["leadtime"];
        $result->productCondition = $row["productconditionid"] ? new DictionaryValue($row["productconditionid"], $row["productconditionname"]) : null;
        $result->productUnit = $row["productunitid"] ? new DictionaryValue($row["productunitid"], $row["productunitname"]) : null;
        $result->productGroup = $row["productgroupid"] ? new DictionaryValue($row["productgroupid"], $row["productgroupname"]) : null;
        $result->weight = $row["weight"];
        $result->weightGross = $row["weightgross"];
        $result->cnCode = $row["cncode"];
        $result->categories = $row["categories"];
        $result->images = $row["images"];

        return $result;
    }
}
