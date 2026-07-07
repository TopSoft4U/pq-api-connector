<?php

declare(strict_types=1);

namespace TopSoft4U\Connector\Tests\Methods\GetProducts;

use PHPUnit\Framework\TestCase;
use TopSoft4U\Connector\Methods\GetProducts\GetProductsItem;
use TopSoft4U\Connector\Methods\GetProducts\GetProductsShipmentBox;

class GetProductsItemTest extends TestCase
{
    public function testFromDataMapsAllFields(): void
    {
        $rows = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/getProducts.json'), true);
        $item = GetProductsItem::FromData($rows[0]);

        self::assertSame(45356, $item->id);
        self::assertSame('2018-09-25 11:34:32', $item->modified);
        self::assertSame('Adhesive foil battery cover Samsung SM-G930F Galaxy S7 (original)', $item->name);
        self::assertSame('GH81-13702A', $item->pid);
        self::assertSame('5901234567890', $item->ean);
        self::assertSame(0, $item->status);
        self::assertFalse($item->allowPriceOffer);
        self::assertFalse($item->askForPrice);
        self::assertSame(0, $item->fkOutletAncestor);
        self::assertNull($item->defect);
        self::assertSame(5, $item->incomingDays);
        self::assertSame(22.93, $item->userPrice);
        self::assertSame(28.2039, $item->userPriceGross);
        self::assertSame(23.0, $item->vatRate);
        self::assertSame('PLN', $item->currency);          // new
        self::assertFalse($item->promotionEnabled);         // new
        self::assertSame(100.0, $item->supplyQty);
        self::assertSame(95.0, $item->qty);
        self::assertFalse($item->eol);
        self::assertFalse($item->forAdults);
        self::assertSame(15.0, $item->sizeX);               // deprecated, still mapped
        self::assertSame(10.0, $item->sizeY);
        self::assertSame(0.5, $item->sizeZ);
        self::assertSame(3, $item->leadTime);
        self::assertNotNull($item->productCondition);
        self::assertNotNull($item->productUnit);
        self::assertNotNull($item->productGroup);
        self::assertSame(0.005, $item->weight);
        self::assertSame(0.01, $item->weightGross);
        self::assertSame('39199000', $item->cnCode);
        self::assertSame('Samsung', $item->brand);          // new
        self::assertSame([2116], $item->categories);
        self::assertSame(['image.png'], $item->images);
        self::assertSame(12, $item->producerId);
        self::assertSame(13, $item->responsibleCompanyId);
        self::assertSame('Keep away from children', $item->safetyInformation);
    }

    public function testShipmentBoxesAreMapped(): void
    {
        $rows = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/getProducts.json'), true);
        $item = GetProductsItem::FromData($rows[0]);

        self::assertCount(1, $item->shipmentBoxes);
        $box = $item->shipmentBoxes[0];
        self::assertInstanceOf(GetProductsShipmentBox::class, $box);
        self::assertSame(15.0, $box->sizeX);
        self::assertSame(10.0, $box->sizeY);
        self::assertSame(0.5, $box->sizeZ);
        self::assertSame(0.01, $box->weightGross);
    }

    public function testEmptyShipmentBoxesDefaultToEmptyArray(): void
    {
        $row = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/getProducts.json'), true)[0];
        unset($row['shipmentboxes']);
        $item = GetProductsItem::FromData($row);

        self::assertSame([], $item->shipmentBoxes);
    }
}
