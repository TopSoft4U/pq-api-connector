<?php

namespace TopSoft4U\Connector\Methods\GetComplaintTypeOptions;

class GetComplaintTypeOptionsItem
{
    public int $value;
    public string $label;
    public bool $disabled;

    public static function FromData(array $data): self
    {
        $item = new self();
        $item->value = (int) $data['value'];
        $item->label = $data['label'];
        $item->disabled = $data['disabled'];

        return $item;
    }
}
