<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetProductCategories;

class GetProductCategoryItem
{
    public int $id;
    public ?string $modified;
    public string $name;
    public ?string $description;
    public int $fkParent;
    public int $order;
    public int $countPublished;
    public bool $forAdults;

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
        $item->fkParent = is_numeric($data["fkparent"]) ? (int)$data["fkparent"] : 0;
        $item->order = is_numeric($data["order"]) ? (int)$data["order"] : 0;
        $item->countPublished = is_numeric($data["countpublished"]) ? (int)$data["countpublished"] : 0;
        $item->forAdults = (bool)$data["foradults"];

        return $item;
    }
}
