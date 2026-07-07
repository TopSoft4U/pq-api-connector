<?php

declare(strict_types=1);

namespace TopSoft4U\Connector\Tests\Methods\GetProductVariants;

use PHPUnit\Framework\TestCase;
use TopSoft4U\Connector\Methods\GetProductVariants\GetProductVariantItem;

class GetProductVariantItemTest extends TestCase
{
    public function testFromDataMapsGroupAndSubItems(): void
    {
        $rows = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/getProductVariants.json'), true);
        $item = GetProductVariantItem::FromData($rows[0]);

        self::assertSame('Materiał', $item->groupName);
        self::assertSame(34, $item->attributeId);
        self::assertSame('variant', $item->type);
        self::assertSame('szt', $item->unit);
        self::assertCount(2, $item->subItems);
        self::assertSame('Silikon', $item->subItems[0]->attributeValue);
        self::assertSame(53278, $item->subItems[0]->productId);
        self::assertTrue($item->subItems[0]->inStock);
        self::assertFalse($item->subItems[0]->fullMatch);
        self::assertTrue($item->subItems[1]->fullMatch);
    }
}
