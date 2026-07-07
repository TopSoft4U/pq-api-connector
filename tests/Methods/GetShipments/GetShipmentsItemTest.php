<?php

declare(strict_types=1);

namespace TopSoft4U\Connector\Tests\Methods\GetShipments;

use PHPUnit\Framework\TestCase;
use TopSoft4U\Connector\Methods\GetShipments\GetShipmentsItem;

class GetShipmentsItemTest extends TestCase
{
    public function testFromDataSplitsCsvFields(): void
    {
        $rows = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/getShipments.json'), true);
        $item = GetShipmentsItem::FromData($rows[0]);

        self::assertSame(100, $item->id);
        self::assertSame(2, $item->state);
        self::assertSame(['FV/1', 'FV/2'], $item->orderDocumentNames);
        self::assertSame(['Z18/1', 'Z18/2'], $item->orderNames);
        self::assertSame(['DPD-12345'], $item->name === null ? [] : [$item->name]);
        self::assertSame('https://dpd.de/track?id=DPD-12345', $item->trackingUrl);
    }
}
