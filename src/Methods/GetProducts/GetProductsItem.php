<?php
declare(strict_types=1);

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

    public string $currency;

    public bool $promotionEnabled;

    public float $supplyQty;
    public float $qty;

    public bool $eol;
    public bool $forAdults;

    /**
     * In cm
     * @var float
     * @deprecated Use $shipmentBoxes instead.
     */
    public float $sizeX;
    /**
     * In cm
     * @var float
     * @deprecated Use $shipmentBoxes instead.
     */
    public float $sizeY;
    /**
     * In cm
     * @var float
     * @deprecated Use $shipmentBoxes instead.
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

    public ?string $brand = null;

    /**
     * @var int[]
     */
    public array $categories;

    /**
     * @var string[]
     */
    public array $images;

    /**
     * @var GetProductsShipmentBox[]
     */
    public array $shipmentBoxes;

    /**
     * @param array<string, mixed> $row
     */
    public static function FromData(array $row): self
    {
        $item = new self();
        $item->id = is_numeric($row["id"]) ? (int)$row["id"] : 0;
        $item->modified = is_string($row["modified"]) ? $row["modified"] : null;
        $item->name = is_string($row["name"]) ? $row["name"] : "";
        $item->pid = is_string($row["pid"]) ? $row["pid"] : null;
        $item->ean = is_string($row["ean"]) ? $row["ean"] : null;
        $item->status = is_numeric($row["status"]) ? (int)$row["status"] : 0;
        $item->allowPriceOffer = (bool)$row["allowpriceoffer"];
        $item->askForPrice = (bool)$row["askforprice"];
        $item->fkOutletAncestor = is_numeric($row["fkoutletancestor"]) ? (int)$row["fkoutletancestor"] : 0;
        $item->defect = is_string($row["defect"]) ? $row["defect"] : null;
        $item->incomingDays = is_numeric($row["incomingdays"]) ? (int)$row["incomingdays"] : null;
        $item->description = is_string($row["description"]) ? $row["description"] : null;
        $item->userPrice = is_numeric($row["userprice"]) ? (float)$row["userprice"] : 0.0;
        $item->userPriceGross = is_numeric($row["userpricegross"]) ? (float)$row["userpricegross"] : 0.0;
        $item->vatRate = is_numeric($row["vatrate"]) ? (float)$row["vatrate"] : 0.0;
        $item->currency = is_string($row["currency"]) ? $row["currency"] : "";
        $item->promotionEnabled = (bool)$row["promotionenabled"];
        $item->supplyQty = is_numeric($row["supplyqty"]) ? (float)$row["supplyqty"] : 0.0;
        $item->qty = is_numeric($row["qty"]) ? (float)$row["qty"] : 0.0;
        $item->eol = (bool)$row["eol"];
        $item->forAdults = (bool)$row["foradults"];
        $item->sizeX = is_numeric($row["size_x"]) ? (float)$row["size_x"] : 0.0;
        $item->sizeY = is_numeric($row["size_y"]) ? (float)$row["size_y"] : 0.0;
        $item->sizeZ = is_numeric($row["size_z"]) ? (float)$row["size_z"] : 0.0;
        $item->leadTime = is_numeric($row["leadtime"]) ? (int)$row["leadtime"] : 0;
        $condId = $row["productconditionid"];
        $item->productCondition = is_numeric($condId) && $condId
            ? new DictionaryValue((int)$condId, is_string($row["productconditionname"]) ? $row["productconditionname"] : "")
            : null;
        $unitId = $row["productunitid"];
        $item->productUnit = is_numeric($unitId) && $unitId
            ? new DictionaryValue((int)$unitId, is_string($row["productunitname"]) ? $row["productunitname"] : "")
            : null;
        $groupId = $row["productgroupid"];
        $item->productGroup = is_numeric($groupId) && $groupId
            ? new DictionaryValue((int)$groupId, is_string($row["productgroupname"]) ? $row["productgroupname"] : "")
            : null;
        $item->weight = is_numeric($row["weight"]) ? (float)$row["weight"] : 0.0;
        $item->weightGross = is_numeric($row["weightgross"]) ? (float)$row["weightgross"] : 0.0;
        $item->cnCode = is_string($row["cncode"]) ? $row["cncode"] : null;
        $item->brand = is_string($row["brand"] ?? null) ? $row["brand"] : null;

        $categories = $row["categories"];
        $catList = [];
        if (is_array($categories)) {
            foreach ($categories as $cid) {
                if (is_numeric($cid)) {
                    $catList[] = (int)$cid;
                }
            }
        }
        $item->categories = $catList;

        $images = $row["images"];
        /** @var string[] $imgList */
        $imgList = [];
        if (is_array($images)) {
            foreach ($images as $img) {
                if (is_string($img)) {
                    $imgList[] = $img;
                }
            }
        }
        $item->images = $imgList;

        $item->shipmentBoxes = [];
        $boxes = $row["shipmentboxes"] ?? [];
        if (is_array($boxes)) {
            foreach ($boxes as $box) {
                if (is_array($box)) {
                    /** @var array<string, mixed> $box */
                    $item->shipmentBoxes[] = GetProductsShipmentBox::FromData($box);
                }
            }
        }

        $item->producerId = is_numeric($row["producerid"]) ? (int)$row["producerid"] : 0;
        $item->responsibleCompanyId = is_numeric($row["responsiblecompanyid"]) ? (int)$row["responsiblecompanyid"] : 0;
        $item->safetyInformation = is_string($row["safetyinformation"]) ? $row["safetyinformation"] : null;

        return $item;
    }
}
