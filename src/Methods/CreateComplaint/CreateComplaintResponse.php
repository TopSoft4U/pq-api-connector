<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\CreateComplaint;

use TopSoft4U\Connector\Utils\NotificationResponse;
use TopSoft4U\Connector\Utils\Notifications;

class CreateComplaintResponse extends NotificationResponse
{
    public int $id;

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = is_numeric($data["id"]) ? (int)$data["id"] : 0;
        $messages = is_array($data["messages"] ?? null) ? $data["messages"] : [];
        /** @var array<string, mixed> $messages */
        $item->messages = Notifications::FromData($messages);

        return $item;
    }
}
