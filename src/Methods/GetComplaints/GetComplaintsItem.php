<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetComplaints;

use TopSoft4U\Connector\Utils\DictionaryValue;

class GetComplaintsItem
{
    public int $id;
    public ?string $created = null;
    public ?string $modified = null;
    public ?string $name = null;
    public ?string $description = null;
    public int $qty;
    public int $fkSale;
    public string $orderNo;
    public string $invoiceNo;

    public DictionaryValue $product;
    public DictionaryValue $complaintStatus;
    public DictionaryValue $complaintType;

    /**
     * @var string[]
     */
    public array $pictures = [];

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = is_numeric($data['id']) ? (int)$data['id'] : 0;
        $item->created = is_string($data['created']) ? $data['created'] : null;
        $item->modified = is_string($data['modified']) ? $data['modified'] : null;
        $item->name = is_string($data['name']) ? $data['name'] : null;
        $item->description = is_string($data['description']) ? $data['description'] : null;
        $item->qty = is_numeric($data['qty']) ? (int)$data['qty'] : 0;
        $item->fkSale = is_numeric($data['fksale']) ? (int)$data['fksale'] : 0;
        $item->orderNo = is_string($data['orderno']) ? $data['orderno'] : "";
        $item->invoiceNo = is_string($data['invoiceno']) ? $data['invoiceno'] : "";

        $item->product = new DictionaryValue(
            is_numeric($data['fkproduct']) ? (int)$data['fkproduct'] : 0,
            is_string($data['productname']) ? $data['productname'] : ""
        );
        $item->complaintStatus = new DictionaryValue(
            is_numeric($data['fkcomplaintstatus']) ? (int)$data['fkcomplaintstatus'] : 0,
            is_string($data['complaintstatusname']) ? $data['complaintstatusname'] : ""
        );
        $item->complaintType = new DictionaryValue(
            is_numeric($data['fkcomplainttype']) ? (int)$data['fkcomplainttype'] : 0,
            is_string($data['complainttypename']) ? $data['complainttypename'] : ""
        );

        // API may return null, "", a single string, or a string[] here. Normalize to array.
        $pictures = $data["pictures"] ?? null;
        $normalized = is_array($pictures)
            ? $pictures
            : ($pictures === null || $pictures === '' ? [] : [$pictures]);
        /** @var string[] $picList */
        $picList = [];
        foreach ($normalized as $pic) {
            if (is_string($pic)) {
                $picList[] = $pic;
            }
        }
        $item->pictures = $picList;

        return $item;
    }
}
