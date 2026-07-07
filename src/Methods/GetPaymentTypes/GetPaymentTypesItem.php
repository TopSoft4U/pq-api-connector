<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetPaymentTypes;

class GetPaymentTypesItem
{
    public int $id;
    public string $name;
    public ?string $description = null;
    public ?string $modified = null;
    public ?string $logo = null;

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = is_numeric($data["id"]) ? (int)$data["id"] : 0;
        $item->name = is_string($data["name"]) ? $data["name"] : "";
        $desc = $data["description"];
        $item->description = is_string($desc) && $desc !== '' ? $desc : null;
        $mod = $data["modified"];
        $item->modified = is_string($mod) && $mod !== '' ? $mod : null;
        $logo = $data["logo"];
        $item->logo = is_string($logo) && $logo !== '' ? $logo : null;

        return $item;
    }
}
