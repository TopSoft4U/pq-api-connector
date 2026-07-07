<?php
declare(strict_types=1);

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
    public int $saleId;
    public ?string $saleDate = null;
    public ?int $saleType = null;

    /**
     * Get the payload that is ready to be saved, for example using file_put_contents
     * @return string
     */
    public function getPayload(): string
    {
        return utf8_decode($this->payload);
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = is_numeric($data["id"]) ? (int)$data["id"] : 0;
        $item->name = is_string($data["name"]) ? $data["name"] : "";
        $item->langIso2 = is_string($data["langiso2"]) ? $data["langiso2"] : "";
        $item->size = is_numeric($data["size"]) ? (int)$data["size"] : 0;
        $item->extension = is_string($data["ext"]) ? $data["ext"] : "";
        $item->mimeType = is_string($data["mime"]) ? $data["mime"] : "";
        $item->payload = is_string($data["payload"]) ? $data["payload"] : "";
        $item->saleId = is_numeric($data["saleid"]) ? (int)$data["saleid"] : 0;
        $item->saleDate = is_string($data["saledate"] ?? null) ? $data["saledate"] : null;
        $st = $data["saletype"] ?? null;
        $item->saleType = is_numeric($st) ? (int)$st : null;

        return $item;
    }
}
