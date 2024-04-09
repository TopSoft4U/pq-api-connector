<?php

namespace TopSoft4U\Connector\Methods\AddProductsToSale;

use TopSoft4U\Connector\Abstracts\PostMethod;
use TopSoft4U\Connector\Utils\NotificationResponse;

class AddProductsToSaleRequest extends PostMethod
{
    private int $id;
    /**
     * @var \TopSoft4U\Connector\Methods\CreateSale\CreateSaleProduct[]
     */
    private array $products;

    public function __construct(int $id, array $products)
    {
        $this->id = $id;
        $this->products = $products;
    }

    public function getUrl(): string
    {
        return "/addProductsToSale";
    }

    public function getQueryParams(): array
    {
        return [];
    }

    public function getBodyData(): array
    {
        return [
            "id" => $this->id,
            "products" => $this->products,
        ];
    }

    public function formatData($data): NotificationResponse
    {
        return NotificationResponse::FromData($data);
    }
}
