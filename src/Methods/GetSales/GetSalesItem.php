<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetSales;

use TopSoft4U\Connector\Methods\GetSale\GetSaleRequest;
use TopSoft4U\Connector\Methods\GetSale\GetSaleResponse;
use TopSoft4U\Connector\Methods\GetSaleDocuments\GetSaleDocumentsRequest;
use TopSoft4U\Connector\Methods\GetSaleECOD\GetSaleECODRequest;
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
    public bool $isShipped;
    public bool $isAttachable;

    /**
     * @var int[]
     */
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
        $data = $request->formatData($response ?? []);
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
        $data = $request->formatData($response ?? []);
        return $data->items;
    }

    public function getECOD(PQApiClient $client): ?string
    {
        $request = new GetSaleECODRequest($this->id);
        $response = $client->sendRequest($request);
        $data = $request->formatData($response ?? []);
        return $data->content;
    }

    public function getDetails(PQApiClient $client): GetSaleResponse
    {
        $request = new GetSaleRequest($this->id);
        $response = $client->sendRequest($request);
        $data = $request->formatData($response ?? []);
        return $data;
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = is_numeric($data['id']) ? (int)$data['id'] : 0;
        $item->type = is_numeric($data['type']) ? (int)$data['type'] : 0;
        $item->created = is_string($data['created']) ? $data['created'] : null;
        $item->modified = is_string($data['modified']) ? $data['modified'] : null;
        $item->invoiceName = is_string($data['invoicename']) ? $data['invoicename'] : null;
        $item->orderName = is_string($data['ordername']) ? $data['ordername'] : null;
        $item->fkCurrency = is_numeric($data['fkcurrency']) ? (int)$data['fkcurrency'] : 0;
        $item->statusName = is_string($data['statusname']) ? $data['statusname'] : "";
        $item->symbol = is_string($data['symbol']) ? $data['symbol'] : "";
        $item->paid = is_numeric($data['paid']) ? (float)$data['paid'] : 0.0;
        $item->total = is_numeric($data['total']) ? (float)$data['total'] : 0.0;
        $item->totalGross = is_numeric($data['totalgross']) ? (float)$data['totalgross'] : 0.0;
        $item->isAssembling = (bool)$data['isassembling'];
        $item->assemblyEnd = is_string($data['assemblyend']) ? $data['assemblyend'] : null;
        $item->paymentDeadline = is_string($data['paymentdeadline']) ? $data['paymentdeadline'] : null;
        $item->paymentTag = is_string($data['paymenttag']) ? $data['paymenttag'] : null;
        $item->paymentTypeId = is_numeric($data['paymenttypeid']) ? (int)$data['paymenttypeid'] : 0;
        $item->paymentTypeName = is_string($data['paymenttypename']) ? $data['paymenttypename'] : "";
        $item->shipmentTypeId = is_numeric($data['shipmenttypeid']) ? (int)$data['shipmenttypeid'] : 0;
        $item->shipmentTypeName = is_string($data['shipmenttypename']) ? $data['shipmenttypename'] : "";
        $item->isShipped = (bool)$data['isshipped'];
        $item->isAttachable = (bool)$data['isattachable'];

        $merged = $data['mergedids'];
        $mergedStr = is_string($merged) ? $merged : '';
        /** @var int[] $mergedIds */
        $mergedIds = array_filter(array_map('intval', explode(',', $mergedStr)));
        $item->mergedIds = $mergedIds;

        return $item;
    }
}
