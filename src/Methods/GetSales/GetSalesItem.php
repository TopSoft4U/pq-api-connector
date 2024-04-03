<?php

namespace TopSoft4U\Connector\Methods\GetSales;

use TopSoft4U\Connector\Methods\GetSaleDocuments\GetSaleDocumentsRequest;
use TopSoft4U\Connector\Methods\GetSalePositions\GetSalePositionsRequest;
use TopSoft4U\Connector\PQApiClient;

class GetSalesItem
{
    public int $id;
    public int $type;
    public ?string $created = null;
    public ?string $modified = null;
    public ?string $invoiceName = null;
    public ?string $orderName = null;
    public int $fkCurrency;

    /**
     * Currency symbol - CZK, EUR, USD etc.
     * @var string
     */
    public string $symbol;

    public string $statusName;
    public float $paid;
    public float $total;
    public float $totalGross;
    public bool $isAssembling;

    /**
     * If isAssembling is true, this field contains the date when the assembling ends
     * @var string|null
     */
    public ?string $assemblyEnd = null;
    public ?string $paymentDeadline = null;
    public ?string $paymentTag = null;
    public int $paymentTypeId;
    public string $paymentTypeName;
    public int $shipmentTypeId;
    public string $shipmentTypeName;
    public bool $isPaid;
    public bool $isPacked;
    public bool $isShipped;
    public array $mergedIds = [];

    /**
     * @param PQApiClient $client
     *
     * @return \TopSoft4U\Connector\Methods\GetSalePositions\GetSalePositionsItem[]
     * @throws \TopSoft4U\Connector\PQApiException
     */
    public function getPositions(PQApiClient $client): array
    {
        $request = new GetSalePositionsRequest($this->id);
        $response = $client->sendRequest($request);
        $data = $request->formatData($response);
        return $data->items;
    }

    /**
     * @param PQApiClient $client
     *
     * @return \TopSoft4U\Connector\Methods\GetSaleDocuments\GetSaleDocumentsItem[]
     * @throws \TopSoft4U\Connector\PQApiException
     */
    public function getDocuments(PQApiClient $client): array
    {
        $request = new GetSaleDocumentsRequest($this->id);
        $response = $client->sendRequest($request);
        $data = $request->formatData($response);
        return $data->items;
    }

    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = $data['id'];
        $item->type = $data['type'];
        $item->created = $data['created'];
        $item->modified = $data['modified'];
        $item->invoiceName = $data['invoicename'];
        $item->orderName = $data['ordername'];
        $item->fkCurrency = $data['fkcurrency'];
        $item->statusName = $data['statusname'];
        $item->symbol = $data['symbol'];
        $item->paid = $data['paid'];
        $item->total = $data['total'];
        $item->totalGross = $data['totalgross'];
        $item->isAssembling = $data['isassembling'];
        $item->assemblyEnd = $data['assemblyend'];
        $item->paymentDeadline = $data['paymentdeadline'];
        $item->paymentTag = $data['paymenttag'];
        $item->paymentTypeId = $data['paymenttypeid'];
        $item->paymentTypeName = $data['paymenttypename'];
        $item->shipmentTypeId = $data['shipmenttypeid'];
        $item->shipmentTypeName = $data['shipmenttypename'];
        $item->isPaid = $data['ispaid'];
        $item->isPacked = $data['ispacked'];
        $item->isShipped = $data['isshipped'];

        $item->mergedIds = array_filter(array_map('intval', explode(',', $data['mergedids'])));

        return $item;
    }
}
