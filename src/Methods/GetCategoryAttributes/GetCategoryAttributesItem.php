<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetCategoryAttributes;

class GetCategoryAttributesItem
{
    public int $id;
    public ?string $modified = null;
    public string $name;
    public ?string $description = null;
    public string $type;
    /**
     * @var int[]
     */
    public array $categoryIds;
    public int $variantType;
    public ?string $unit = null;


    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = is_numeric($data["id"]) ? (int)$data["id"] : 0;
        $item->modified = is_string($data["modified"]) ? $data["modified"] : null;
        $item->name = is_string($data["name"]) ? $data["name"] : "";
        $item->description = is_string($data["description"]) ? $data["description"] : null;
        $item->type = is_string($data["type"]) ? $data["type"] : "";
        $categoryIds = $data["categoryids"];
        $ids = [];
        if (is_array($categoryIds)) {
            foreach ($categoryIds as $cid) {
                if (is_numeric($cid)) {
                    $ids[] = (int)$cid;
                }
            }
        }
        $item->categoryIds = $ids;
        $item->variantType = is_numeric($data["varianttype"]) ? (int)$data["varianttype"] : 0;
        $item->unit = is_string($data["unit"]) ? $data["unit"] : null;

        return $item;
    }
}
