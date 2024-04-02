<?php

namespace TopSoft4U\Connector\Methods\GetProductMedia;

class GetProductMediaItem
{
    public int $id;
    public ?string $name;
    public ?string $mediaName;
    public ?string $created;
    public string $src;
    public string $ext;
    public int $size;

    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = $data["id"];
        $item->name = $data["name"];
        $item->mediaName = $data["medianame"];
        $item->created = $data["created"];
        $item->src = $data["src"];
        $item->ext = $data["ext"];
        $item->size = $data["size"] ?? 0;

        return $item;
    }
}
