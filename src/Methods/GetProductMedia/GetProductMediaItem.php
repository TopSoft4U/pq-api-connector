<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetProductMedia;

class GetProductMediaItem
{
    public ?string $name;
    public ?string $created;
    public string $src;
    public string $ext;
    public int $size;
    public int $fkProduct;

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $item = new self();
        $item->name = is_string($data["name"] ?? null) ? $data["name"] : null;
        $item->created = is_string($data["created"] ?? null) ? $data["created"] : null;
        $item->src = is_string($data["src"]) ? $data["src"] : "";
        $item->ext = is_string($data["ext"]) ? $data["ext"] : "";
        $size = $data["size"] ?? 0;
        $item->size = is_numeric($size) ? (int)$size : 0;
        $fkp = $data["fkproduct"];
        $item->fkProduct = is_numeric($fkp) ? (int)$fkp : 0;

        return $item;
    }
}
