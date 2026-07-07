<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetComplaintTypeOptions;

class GetComplaintTypeOptionsItem
{
    public int $value;
    public string $label;
    public bool $disabled;

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $item = new self();
        $item->value = is_numeric($data['value']) ? (int)$data['value'] : 0;
        $item->label = is_string($data['label']) ? $data['label'] : "";
        $item->disabled = (bool)$data['disabled'];

        return $item;
    }
}
