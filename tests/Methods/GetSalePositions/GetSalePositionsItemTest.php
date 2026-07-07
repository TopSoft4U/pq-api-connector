<?php

declare(strict_types=1);

namespace TopSoft4U\Connector\Tests\Methods\GetSalePositions;

use PHPUnit\Framework\TestCase;
use TopSoft4U\Connector\Methods\GetSalePositions\GetSalePositionsItem;

class GetSalePositionsItemTest extends TestCase
{
    public function testLeadTimeIsInt(): void
    {
        $rows = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/getSalePositions.json'), true);
        $item = GetSalePositionsItem::FromData($rows[0]);

        self::assertSame(3, $item->leadTime);
        self::assertSame(45356, $item->fkProduct);
        self::assertSame(2.0, $item->qty);
    }
}
