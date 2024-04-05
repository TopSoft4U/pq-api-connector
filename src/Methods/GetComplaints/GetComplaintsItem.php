<?php

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

    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = $data['id'];
        $item->created = $data['created'];
        $item->modified = $data['modified'];
        $item->name = $data['name'];
        $item->description = $data['description'];
        $item->qty = $data['qty'];
        $item->fkSale = $data['fksale'];
        $item->orderNo = $data['orderno'];
        $item->invoiceNo = $data['invoiceno'];

        $item->product = new DictionaryValue($data['fkproduct'], $data['productname']);
        $item->complaintStatus = new DictionaryValue($data['fkcomplaintstatus'], $data['complaintstatusname']);
        $item->complaintType = new DictionaryValue($data['fkcomplainttype'], $data['complainttypename']);

        $item->pictures = $data["pictures"];

        return $item;
    }
}
