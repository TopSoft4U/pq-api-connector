<?php

namespace TopSoft4U\Connector\Methods\CancelSale;

use TopSoft4U\Connector\Abstracts\GetMethod;
use TopSoft4U\Connector\Utils\NotificationResponse;

class CancelSaleRequest extends GetMethod
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getUrl(): string
    {
        return "/cancelSale";
    }

    public function getQueryParams(): array
    {
        return [
            "id" => $this->id,
        ];
    }

    public function formatData($data): NotificationResponse
    {
        return NotificationResponse::FromData($data);
    }
}
