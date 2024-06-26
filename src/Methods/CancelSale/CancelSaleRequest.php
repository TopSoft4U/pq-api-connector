<?php

namespace TopSoft4U\Connector\Methods\CancelSale;

use TopSoft4U\Connector\Abstracts\GetRequest;
use TopSoft4U\Connector\Utils\NotificationResponse;

class CancelSaleRequest extends GetRequest
{
    private int $id;

    public function __construct(int $id)
    {
        if ($id <= 0)
            throw new \InvalidArgumentException("ID must be greater than 0");

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
