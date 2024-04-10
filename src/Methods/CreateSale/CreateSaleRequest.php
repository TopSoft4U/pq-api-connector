<?php

namespace TopSoft4U\Connector\Methods\CreateSale;

use TopSoft4U\Connector\Abstracts\PostRequest;
use TopSoft4U\Connector\Utils\Currency;
use TopSoft4U\Connector\Utils\SaleDocType;

class CreateSaleRequest extends PostRequest
{
    public int $fkShipmentType;
    public int $fkPaymentType;
    public SaleDocType $docType;

    public ?string $pickupPoint = null;

    public ?Currency $currency = null;
    public ?string $notice = null;

    public bool $isAssembling = false;

    private bool $shipmentDiffInvoice = false;
    private ?CreateSaleShipping $shipping = null;

    /**
     * @var \TopSoft4U\Connector\Methods\CreateSale\CreateSaleProduct[]
     */
    public array $products = [];

    public ?CreateSaleOwnLabel $ownLabel = null;

    public function __construct(int $fkShipmentType, int $fkPaymentType, SaleDocType $docType)
    {
        if ($fkShipmentType <= 0)
            throw new \InvalidArgumentException("Shipment type ID must be greater than 0");

        if ($fkPaymentType <= 0)
            throw new \InvalidArgumentException("Payment type ID must be greater than 0");

        $this->fkShipmentType = $fkShipmentType;
        $this->fkPaymentType = $fkPaymentType;
        $this->docType = $docType;
    }

    public function getUrl(): string
    {
        return "/createSale";
    }

    public function getQueryParams(): array
    {
        return [];
    }

    public function getBodyData(): array
    {
        $result = [
            "fkshipmenttype" => $this->fkShipmentType,
            "fkpaymenttype" => $this->fkPaymentType,
            "doc_type" => $this->docType,
            "shipment_diff_invoice" => $this->shipmentDiffInvoice,
            "is_assembling" => $this->isAssembling,
            "products" => $this->products,
        ];

        if ($this->currency)
            $result["currency"] = $this->currency;

        if ($this->notice)
            $result["notice"] = $this->notice;

        if ($this->pickupPoint)
            $result["pickup_point"] = $this->pickupPoint;

        if ($this->shipmentDiffInvoice && $this->shipping)
            $result["shipping"] = $this->shipping;

        if ($this->ownLabel)
            $result["own_label"] = $this->ownLabel;

        return $result;
    }

    public function formatData($data): CreateSaleResponse
    {
        return CreateSaleResponse::FromData($data);
    }

    public function setDifferentDelivery(CreateSaleShipping $shipping)
    {
        $this->shipmentDiffInvoice = true;
        $this->shipping = $shipping;
    }
}
