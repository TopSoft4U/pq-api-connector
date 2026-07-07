<?php

declare(strict_types=1);

namespace TopSoft4U\Connector\Tests\Methods\GetGPSREntities;

use PHPUnit\Framework\TestCase;
use TopSoft4U\Connector\Methods\GetGPSREntities\GetGPSREntitiesItem;

class GetGPSREntitiesItemTest extends TestCase
{
    public function testFromDataMapsCountryAndNullableContacts(): void
    {
        $rows = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/getGPSREntities.json'), true);

        $full = GetGPSREntitiesItem::FromData($rows[0]);
        self::assertSame(12, $full->id);
        self::assertSame('Warszawa', $full->city);
        self::assertSame('info@producer.example', $full->email);
        self::assertSame('PL', $full->country->iso);
        self::assertSame('Poland', $full->country->name);
        self::assertSame(171, $full->country->id);

        $nulls = GetGPSREntitiesItem::FromData($rows[1]);
        self::assertNull($nulls->email);
        self::assertNull($nulls->phone);
        self::assertNull($nulls->url);
    }
}
