<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetProductAttributes;

class GetProductAttributeItem
{
    public ?int $id;
    public ?string $name;
    public ?string $type;
    public string $value;
    public ?string $from = null;
    public ?string $to = null;
    public int $fkProduct;
    public int $fkCategory;
    public bool $isGrouping;

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = is_numeric($data["id"]) ? (int)$data["id"] : null;
        $item->name = is_string($data["name"]) ? $data["name"] : null;
        $item->type = is_string($data["type"]) ? $data["type"] : null;
        $item->value = is_string($data["value"]) ? $data["value"] : "";
        $item->from = is_string($data["from"] ?? null) ? $data["from"] : null;
        $item->to = is_string($data["to"] ?? null) ? $data["to"] : null;
        $item->fkProduct = is_numeric($data["fkproduct"]) ? (int)$data["fkproduct"] : 0;
        $item->fkCategory = is_numeric($data["fkcategory"]) ? (int)$data["fkcategory"] : 0;
        $item->isGrouping = (bool)$data["isgrouping"];

        return $item;
    }
}
