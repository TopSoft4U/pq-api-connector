<?php

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
    public array $children = [];

    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = $data["id"];
        $item->modified = $data["modified"];
        $item->name = $data["name"];
        $item->fkParent = $data["fkparent"];
        $item->order = $data["order"];
        $item->countPublished = $data["countpublished"];
        $item->visible = $data["visible"];

        foreach ($data["children"] as $child) {
            $item->children[] = self::FromData($child);
        }

        return $item;
    }
}
