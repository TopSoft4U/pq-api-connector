<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetProductCategoryTree;

class GetProductCategoryTreeItem
{
    public int $id;
    public ?string $modified;
    public string $name;
    public int $fkParent;
    public int $order;
    public int $countPublished;
    public bool $visible;
    /**
     * @var \TopSoft4U\Connector\Methods\GetProductCategoryTree\GetProductCategoryTreeItem[]
     */
    public array $children = [];

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = is_numeric($data["id"]) ? (int)$data["id"] : 0;
        $item->modified = is_string($data["modified"]) ? $data["modified"] : null;
        $item->name = is_string($data["name"]) ? $data["name"] : "";
        $item->fkParent = is_numeric($data["fkparent"]) ? (int)$data["fkparent"] : 0;
        $item->order = is_numeric($data["order"]) ? (int)$data["order"] : 0;
        $item->countPublished = is_numeric($data["countpublished"]) ? (int)$data["countpublished"] : 0;
        $item->visible = (bool)$data["visible"];

        $children = $data["children"] ?? [];
        if (is_array($children)) {
            foreach ($children as $child) {
                if (is_array($child)) {
                    /** @var array<string, mixed> $child */
                    $item->children[] = self::FromData($child);
                }
            }
        }

        return $item;
    }
}
