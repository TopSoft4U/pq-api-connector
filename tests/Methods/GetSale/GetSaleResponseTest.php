<?php

declare(strict_types=1);

namespace TopSoft4U\Connector\Tests\Methods\GetSale;

use PHPUnit\Framework\TestCase;
use TopSoft4U\Connector\Methods\GetSale\GetSaleResponse;

class GetSaleResponseTest extends TestCase
{
    public function testFromDataMapsAllFields(): void
    {
        $data = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/getSale.json'), true);
        $item = GetSaleResponse::FromData($data);

        self::assertSame(205430, $item->id);
        self::assertSame(-1, $item->type);
        self::assertSame('PLN', $item->symbol);
        self::assertSame('jan@example.com', $item->email);     // new field

        // The renamed (was $shipmentCountry) property:
        self::assertTrue(property_exists($item, 'shipmentPrice'));
        self::assertFalse(property_exists($item, 'shipmentCountry'));
        self::assertSame(5.0, $item->shipmentPrice);
        self::assertSame(6.15, $item->shipmentPriceGross);

        self::assertSame([1, 2, 3], $item->mergedIDs);
    }
}
