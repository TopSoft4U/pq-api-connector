<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\CreateSale;

use TopSoft4U\Connector\Utils\NotificationResponse;
use TopSoft4U\Connector\Utils\Notifications;

class CreateSaleResponse extends NotificationResponse
{
    /**
     * @var int[]
     */
    public array $ids;

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $item = new self();
        $idsRaw = $data["ids"];
        $ids = [];
        if (is_array($idsRaw)) {
            foreach ($idsRaw as $id) {
                if (is_numeric($id)) {
                    $ids[] = (int)$id;
                }
            }
        }
        $item->ids = $ids;
        $messages = is_array($data["messages"] ?? null) ? $data["messages"] : [];
        /** @var array<string, mixed> $messages */
        $item->messages = Notifications::FromData($messages);

        return $item;
    }
}
