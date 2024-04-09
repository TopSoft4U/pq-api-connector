<?php

namespace TopSoft4U\Connector\Utils;

class Notifications
{
    /**
     * @var string[]
     */
    public array $warning = [];

    /**
     * @var string[]
     */
    public array $danger = [];

    /**
     * @var string[]
     */
    public array $info = [];

    /**
     * @var string[]
     */
    public array $success = [];

    public static function FromData(array $data): self
    {
        $result = new self();
        $result->warning = $data["warning"] ?? [];
        $result->danger = $data["danger"] ?? [];
        $result->info = $data["info"] ?? [];
        $result->success = $data["success"] ?? [];

        return $result;
    }
}
