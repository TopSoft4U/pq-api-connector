<?php
declare(strict_types=1);

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

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $result = new self();
        $result->warning = self::stringList($data["warning"] ?? []);
        $result->danger = self::stringList($data["danger"] ?? []);
        $result->info = self::stringList($data["info"] ?? []);
        $result->success = self::stringList($data["success"] ?? []);

        return $result;
    }

    /**
     * @param mixed $value
     * @return string[]
     */
    private static function stringList($value): array
    {
        if (!is_array($value)) {
            return [];
        }

        $strings = [];
        foreach ($value as $item) {
            if (!is_string($item)) {
                continue;
            }
            $strings[] = $item;
        }
        return $strings;
    }
}
