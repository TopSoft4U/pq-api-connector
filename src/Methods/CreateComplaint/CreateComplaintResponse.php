<?php

namespace TopSoft4U\Connector\Methods\CreateComplaint;

use TopSoft4U\Connector\Utils\NotificationResponse;
use TopSoft4U\Connector\Utils\Notifications;

class CreateComplaintResponse extends NotificationResponse
{
    public int $id;

    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = $data["id"];
        $item->messages = Notifications::FromData($data["messages"]);

        return $item;
    }
}
