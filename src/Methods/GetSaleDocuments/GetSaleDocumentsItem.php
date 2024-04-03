<?php

namespace TopSoft4U\Connector\Methods\GetSaleDocuments;

class GetSaleDocumentsItem
{
    public int $id;
    public string $name;
    public string $langIso2;
    public int $size;
    public string $extension;
    public string $mimeType;
    public string $payload;

    /**
     * Get the payload that is ready to be saved, for example using file_put_contents
     * @return string
     */
    public function getPayload(): string
    {
        return utf8_decode($this->payload);
    }

    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = $data["id"];
        $item->name = $data["name"];
        $item->langIso2 = $data["langiso2"];
        $item->size = $data["size"];
        $item->extension = $data["ext"];
        $item->mimeType = $data["mime"];
        $item->payload = $data["payload"];

        return $item;
    }
}
