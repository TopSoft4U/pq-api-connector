<?php

namespace TopSoft4U\Connector\Utils;

class NotificationResponse
{
    public Notifications $messages;

    public static function FromData(array $data): self
    {
        $result = new self();
        $result->messages = Notifications::FromData($data["messages"] ?? []);

        return $result;
    }
}
