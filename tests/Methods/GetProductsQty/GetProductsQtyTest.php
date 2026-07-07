<?php

declare(strict_types=1);

namespace TopSoft4U\Connector\Tests\Methods\GetProductsQty;

use PHPUnit\Framework\TestCase;
use TopSoft4U\Connector\Methods\GetProductsQty\GetProductsQtyItem;
use TopSoft4U\Connector\Methods\GetProductsQty\GetProductsQtyRequest;

class GetProductsQtyTest extends TestCase
{
    public function testItemMapsCurrency(): void
    {
        $rows = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/getProductsQty.json'), true);
        $item = GetProductsQtyItem::FromData($rows[0]);
        self::assertSame('PLN', $item->currency);
    }

    public function testRequestIsPaginatedAndExposesEan(): void
    {
        $request = new GetProductsQtyRequest();
        $request->ean = '123';
        $request->limit = 10;
        self::assertSame(['ean' => '123', 'limit' => 10], $request->getQueryParams());
    }
}
