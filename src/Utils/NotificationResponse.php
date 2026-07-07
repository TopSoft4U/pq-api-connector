<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Utils;

class NotificationResponse
{
    public Notifications $messages;

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $result = new self();
        /** @var array<string, mixed> $messages */
        $messages = is_array($data["messages"] ?? null) ? $data["messages"] : [];
        $result->messages = Notifications::FromData($messages);

        return $result;
    }
}
