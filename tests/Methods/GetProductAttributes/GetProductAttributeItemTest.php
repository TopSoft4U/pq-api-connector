<?php

declare(strict_types=1);

namespace TopSoft4U\Connector\Tests\Methods\GetProductAttributes;

use PHPUnit\Framework\TestCase;
use TopSoft4U\Connector\Methods\GetProductAttributes\GetProductAttributeItem;

class GetProductAttributeItemTest extends TestCase
{
    public function testFromDataMapsFromToRangeFields(): void
    {
        $rows = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/getProductAttributes.json'), true);

        $text = GetProductAttributeItem::FromData($rows[0]);
        self::assertSame('', $text->from);
        self::assertSame('', $text->to);

        $range = GetProductAttributeItem::FromData($rows[1]);
        self::assertSame('0', $range->from);   // new
        self::assertSame('1', $range->to);     // new
        self::assertTrue($range->isGrouping);
    }
}
