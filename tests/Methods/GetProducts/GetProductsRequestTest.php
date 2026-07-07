<?php

declare(strict_types=1);

namespace TopSoft4U\Connector\Tests\Methods\GetProducts;

use PHPUnit\Framework\TestCase;
use TopSoft4U\Connector\Methods\GetProducts\GetProductsRequest;

class GetProductsRequestTest extends TestCase
{
    public function testIsPaginated(): void
    {
        $request = new GetProductsRequest();
        self::assertSame([], $request->getQueryParams());

        $request->limit = 50;
        $request->page = 2;
        self::assertSame(['limit' => 50, 'page' => 2], $request->getQueryParams());
    }

    public function testOwnParamsAndNewFiltersAreExposed(): void
    {
        $request = new GetProductsRequest();
        $request->ean = '5901234';
        $request->longestEdgeAbove = 30.0;
        $request->weightGrossBelow = 1.0;
        $request->userPriceGrossAbove = 5.0;

        $params = $request->getQueryParams();
        self::assertSame('5901234', $params['ean']);
        self::assertSame(30.0, $params['longest_edge_above']);
        self::assertSame(1.0, $params['weight_gross_below']);
        self::assertSame(5.0, $params['user_price_gross_above']);
    }
}
