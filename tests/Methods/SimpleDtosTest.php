<?php

declare(strict_types=1);

namespace TopSoft4U\Connector\Tests\Methods;

use PHPUnit\Framework\TestCase;
use TopSoft4U\Connector\Methods\GetCategoryAttributes\GetCategoryAttributesItem;
use TopSoft4U\Connector\Methods\GetComplaintReasons\GetComplaintReasonsRequest;
use TopSoft4U\Connector\Methods\GetComplaintStatuses\GetComplaintStatusesRequest;
use TopSoft4U\Connector\Methods\GetComplaintTypeOptions\GetComplaintTypeOptionsItem;
use TopSoft4U\Connector\Methods\GetPaymentTypes\GetPaymentTypesItem;
use TopSoft4U\Connector\Methods\GetProductCategories\GetProductCategoryItem;
use TopSoft4U\Connector\Methods\GetProductCategoryTree\GetProductCategoryTreeItem;
use TopSoft4U\Connector\Methods\GetShipmentTypes\GetShipmentTypesItem;
use TopSoft4U\Connector\Utils\DictionaryValue;

/** Covers the smaller list-style DTOs in one place. */
class SimpleDtosTest extends TestCase
{
    private function fixture(string $name): array
    {
        return json_decode(file_get_contents(__DIR__ . '/../Fixtures/' . $name), true);
    }

    public function testGetCategoryAttributesItem(): void
    {
        $item = GetCategoryAttributesItem::FromData($this->fixture('getCategoryAttributes.json')[0]);
        self::assertSame('Color', $item->name);
        self::assertSame([2116, 2117], $item->categoryIds);
        self::assertSame(1, $item->variantType);
    }

    public function testGetComplaintReasons(): void
    {
        $resp = (new GetComplaintReasonsRequest())->formatData($this->fixture('getComplaintReasons.json'));
        self::assertCount(2, $resp->items);
        self::assertInstanceOf(DictionaryValue::class, $resp->items[0]);
        self::assertSame('Damaged', $resp->items[0]->name);
    }

    public function testGetComplaintStatuses(): void
    {
        $resp = (new GetComplaintStatusesRequest())->formatData($this->fixture('getComplaintStatuses.json'));
        self::assertSame('Open', $resp->items[0]->name);
    }

    public function testGetComplaintTypeOptionsItem(): void
    {
        $rows = $this->fixture('getComplaintTypeOptions.json');
        $item = GetComplaintTypeOptionsItem::FromData($rows[1]);
        self::assertSame('Missing', $item->label);
        self::assertSame(1, $item->value);
        self::assertTrue($item->disabled);
    }

    public function testGetPaymentTypesItem(): void
    {
        $item = GetPaymentTypesItem::FromData($this->fixture('getPaymentTypes.json')[0]);
        self::assertSame('PayPal', $item->name);
        self::assertSame('paypal.png', $item->logo);
    }

    public function testGetShipmentTypesItem(): void
    {
        $item = GetShipmentTypesItem::FromData($this->fixture('getShipmentTypes.json')[0]);
        self::assertSame('DPD', $item->name);
        self::assertSame(30.0, $item->maxWeight);
    }

    public function testGetProductCategoryItem(): void
    {
        $item = GetProductCategoryItem::FromData($this->fixture('getProductCategories.json')[0]);
        self::assertSame(2622, $item->fkParent);
        self::assertSame(39, $item->countPublished);
        self::assertFalse($item->forAdults);
    }

    public function testGetProductCategoryTreeItemRecursive(): void
    {
        $item = GetProductCategoryTreeItem::FromData($this->fixture('getProductCategoryTree.json')[0]);
        self::assertSame(2000, $item->id);
        self::assertCount(1, $item->children);
        self::assertSame(2116, $item->children[0]->id);
        self::assertSame([], $item->children[0]->children);
    }
}
