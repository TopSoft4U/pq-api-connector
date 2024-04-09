<?php

namespace TopSoft4U\Connector\Methods\CreateSale;

use TopSoft4U\Connector\Utils\NotificationResponse;
use TopSoft4U\Connector\Utils\Notifications;

class CreateSaleResponse extends NotificationResponse
{
    public array $ids;

    public static function FromData(array $data): self
    {
        $item = new self();
        $item->ids = $data["ids"];
        $item->messages = Notifications::FromData($data["messages"]);

        return $item;
    }
}
