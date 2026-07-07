<?php

declare(strict_types=1);

namespace TopSoft4U\Connector\Tests\Methods\GetAvailableDeliveryOptions;

use PHPUnit\Framework\TestCase;
use TopSoft4U\Connector\Methods\GetAvailableDeliveryOptions\GetAvailableDeliveryOptionsItem;

class GetAvailableDeliveryOptionsItemTest extends TestCase
{
    public function testFromDataMapsMaxSizeFields(): void
    {
        $rows = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/getAvailableDeliveryOptions.json'), true);
        $item = GetAvailableDeliveryOptionsItem::FromData($rows[0]);

        self::assertSame(100.0, $item->maxLength);
        self::assertSame(60.0, $item->maxSizeX);   // new
        self::assertSame(40.0, $item->maxSizeY);   // new
        self::assertSame(30.0, $item->maxSizeZ);   // new
        self::assertSame(5.0, $item->price);
        self::assertCount(1, $item->payments);
        self::assertSame(5, $item->payments[0]->paymentId);
    }
}
