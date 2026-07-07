<?php

declare(strict_types=1);

namespace TopSoft4U\Connector\Tests\Methods\GetProductMedia;

use PHPUnit\Framework\TestCase;
use TopSoft4U\Connector\Methods\GetProductMedia\GetProductMediaItem;

class GetProductMediaItemTest extends TestCase
{
    public function testFromDataMapsDocumentedShapeOnly(): void
    {
        $rows = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/getProductMedia.json'), true);
        $item = GetProductMediaItem::FromData($rows[0]);

        // No id/mediaName properties should exist (they mapped non-existent keys before)
        self::assertFalse(property_exists($item, 'id'));
        self::assertFalse(property_exists($item, 'mediaName'));

        self::assertSame('image.png', $item->name);
        self::assertSame('2018-09-25 11:34:32', $item->created);
        self::assertSame('https://example.com/image.php?name=abc.png', $item->src);
        self::assertSame('png', $item->ext);
        self::assertSame(369619, $item->size);
        self::assertSame(45356, $item->fkProduct);   // new field
    }
}
