<?php

declare(strict_types=1);

namespace TopSoft4U\Connector\Tests\Methods;

use PHPUnit\Framework\TestCase;
use TopSoft4U\Connector\Methods\GetCategoryAttributes\GetCategoryAttributesRequest;
use TopSoft4U\Connector\Methods\GetGPSREntities\GetGPSREntitiesRequest;
use TopSoft4U\Connector\Methods\GetProductCategories\GetProductCategoriesRequest;
use TopSoft4U\Connector\Methods\GetSales\GetSalesRequest;
use TopSoft4U\Connector\Methods\GetShipments\GetShipmentsRequest;
use TopSoft4U\Connector\Methods\GetProducts\GetProductsRequest;
use TopSoft4U\Connector\Methods\GetProductsQty\GetProductsQtyRequest;

/**
 * Verifies the 7 paginated endpoints expose optional limit/page without
 * enforcement and still return their own params.
 */
class PaginationTest extends TestCase
{
    public function paginatedRequests(): array
    {
        return [
            'getProducts'         => [new GetProductsRequest()],
            'getProductsQty'      => [new GetProductsQtyRequest()],
            'getProductCategories'=> [new GetProductCategoriesRequest()],
            'getCategoryAttributes' => [new GetCategoryAttributesRequest()],
            'getSales'            => [new GetSalesRequest()],
            'getShipments'        => [new GetShipmentsRequest()],
            'getGPSREntities'     => [new GetGPSREntitiesRequest()],
        ];
    }

    /**
     * @dataProvider paginatedRequests
     */
    public function testEmptyPaginationIsNotAdded(object $request): void
    {
        self::assertArrayNotHasKey('limit', $request->getQueryParams());
        self::assertArrayNotHasKey('page', $request->getQueryParams());
    }

    /**
     * @dataProvider paginatedRequests
     */
    public function testPaginationIsAppended(object $request): void
    {
        $request->limit = 100;
        $request->page = 3;
        $params = $request->getQueryParams();
        self::assertSame(100, $params['limit']);
        self::assertSame(3, $params['page']);
    }
}
