<?php

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

    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = $data["id"];
        $item->modified = $data["modified"];
        $item->name = $data["name"];
        $item->description = $data["description"];
        $item->fkParent = $data["fkparent"];
        $item->order = $data["order"];
        $item->countPublished = $data["countpublished"];
        $item->forAdults = $data["foradults"];

        return $item;
    }
}
