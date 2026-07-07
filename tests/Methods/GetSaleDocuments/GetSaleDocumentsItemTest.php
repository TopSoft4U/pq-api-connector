<?php

declare(strict_types=1);

namespace TopSoft4U\Connector\Tests\Methods\GetSaleDocuments;

use PHPUnit\Framework\TestCase;
use TopSoft4U\Connector\Methods\GetSaleDocuments\GetSaleDocumentsItem;

class GetSaleDocumentsItemTest extends TestCase
{
    public function testFromDataMapsSaleFields(): void
    {
        $rows = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/getSaleDocuments.json'), true);
        $item = GetSaleDocumentsItem::FromData($rows[0]);

        self::assertSame(12345, $item->saleId);          // new
        self::assertSame('2018-09-28 13:47:28', $item->saleDate);  // new
        self::assertSame(0, $item->saleType);            // new
        self::assertSame('application/pdf', $item->mimeType);
        self::assertSame('pdf', $item->extension);
    }
}
