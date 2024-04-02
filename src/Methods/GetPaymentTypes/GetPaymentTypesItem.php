<?php

namespace TopSoft4U\Connector\Methods\GetPaymentTypes;

class GetPaymentTypesItem
{
    public int $id;
    public string $name;
    public ?string $description = null;
    public ?string $modified = null;
    public ?string $logo = null;

    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = $data["id"];
        $item->name = $data["name"];
        $item->description = $data["description"] ?: null;
        $item->modified = $data["modified"] ?: null;
        $item->logo = $data["logo"] ?: null;

        return $item;
    }
}
