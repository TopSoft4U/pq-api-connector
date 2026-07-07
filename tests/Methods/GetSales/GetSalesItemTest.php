<?php

declare(strict_types=1);

namespace TopSoft4U\Connector\Tests\Methods\GetSales;

use PHPUnit\Framework\TestCase;
use TopSoft4U\Connector\Methods\GetSales\GetSalesItem;

class GetSalesItemTest extends TestCase
{
    public function testFromDataMapsFieldsAndSplitsMergedIds(): void
    {
        $rows = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/getSales.json'), true);
        $item = GetSalesItem::FromData($rows[0]);

        self::assertSame(205430, $item->id);
        self::assertSame(-1, $item->type);
        self::assertSame('PayPal', $item->paymentTypeName);
        self::assertSame('DPD', $item->shipmentTypeName);
        self::assertTrue($item->isAttachable);
        self::assertSame([1, 2, 3], $item->mergedIds);
    }
}
