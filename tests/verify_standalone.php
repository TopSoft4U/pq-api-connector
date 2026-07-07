<?php

declare(strict_types=1);

/**
 * Standalone verification runner — runs WITHOUT PHPUnit (uses only core PHP
 * extensions) so the DTO mappings can be sanity-checked in environments where
 * PHPUnit / php-xml / php-mbstring are not installed.
 *
 * Usage: php tests/verify_standalone.php
 *
 * Exits non-zero on any failure. This is NOT a replacement for the PHPUnit
 * suite (tests/Methods/*Test.php) — it is a lightweight mirror of the same
 * assertions for environments that cannot run PHPUnit.
 */

require __DIR__ . '/../src/autoload.php';

$fixDir = __DIR__ . '/Fixtures';
function fix(string $name, string $dir): array { return json_decode(file_get_contents("$dir/$name"), true); }

$failures = [];
function check(string $label, bool $ok): void {
    global $failures;
    if (!$ok) { $failures[] = $label; fwrite(STDERR, "FAIL: $label\n"); }
    else { echo "ok: $label\n"; }
}

/* ---------- GetProducts ---------- */
$rows = fix('getProducts.json', $fixDir);
$item = \TopSoft4U\Connector\Methods\GetProducts\GetProductsItem::FromData($rows[0]);
check('products.id', $item->id === 45356);
check('products.currency', $item->currency === 'PLN');
check('products.promotionEnabled', $item->promotionEnabled === false);
check('products.brand', $item->brand === 'Samsung');
check('products.categories', $item->categories === [2116]);
check('products.shipmentBoxes count', count($item->shipmentBoxes) === 1);
check('products.shipmentBox.sizeX', $item->shipmentBoxes[0]->sizeX === 15.0);
check('products.shipmentBox.weightGross', $item->shipmentBoxes[0]->weightGross === 0.01);
check('products.sizeX still mapped (deprecated)', $item->sizeX === 15.0);

/* ---------- GetProductsRequest (pagination + new filters) ---------- */
$req = new \TopSoft4U\Connector\Methods\GetProducts\GetProductsRequest();
$req->limit = 50; $req->page = 2; $req->ean = '5901234'; $req->longestEdgeAbove = 30.0;
$p = $req->getQueryParams();
check('products.request.limit', ($p['limit'] ?? null) === 50);
check('products.request.page', ($p['page'] ?? null) === 2);
check('products.request.ean', ($p['ean'] ?? null) === '5901234');
check('products.request.longest_edge_above', ($p['longest_edge_above'] ?? null) === 30.0);
$req2 = new \TopSoft4U\Connector\Methods\GetProducts\GetProductsRequest();
$p2 = $req2->getQueryParams();
check('products.request empty omits pagination', !isset($p2['limit']) && !isset($p2['page']));

/* ---------- GetSale (rename + email) ---------- */
$saleData = fix('getSale.json', $fixDir);
$sale = \TopSoft4U\Connector\Methods\GetSale\GetSaleResponse::FromData($saleData);
check('sale.email', $sale->email === 'jan@example.com');
check('sale.shipmentPrice renamed', $sale->shipmentPrice === 5.0);
check('sale.shipmentCountry removed', !property_exists($sale, 'shipmentCountry'));

/* ---------- GetProductMedia (bug fix: no id/mediaName, has fkProduct) ---------- */
$pmRows = fix('getProductMedia.json', $fixDir);
$pm = \TopSoft4U\Connector\Methods\GetProductMedia\GetProductMediaItem::FromData($pmRows[0]);
check('media.no id', !property_exists($pm, 'id'));
check('media.no mediaName', !property_exists($pm, 'mediaName'));
check('media.fkProduct', $pm->fkProduct === 45356);
check('media.size', $pm->size === 369619);

/* ---------- CreateComplaint (qty not quantity) ---------- */
$cc = new \TopSoft4U\Connector\Methods\CreateComplaint\CreateComplaintRequest(
    1, 3, 45356, 2.0, 'Defective product please replace', 'PL60102010263000401111000000', 'BPKOPLPW'
);
$body = $cc->getBodyData();
check('complaint.qty present', array_key_exists('qty', $body) && $body['qty'] === 2.0);
check('complaint.quantity absent', !array_key_exists('quantity', $body));

/* ---------- GetAccountData (currency) ---------- */
$ad = \TopSoft4U\Connector\Methods\GetAccountData\GetAccountDataResponse::FromData(fix('getAccountData.json', $fixDir));
check('account.currency', $ad->currency === 'PLN');

/* ---------- GetAvailableDeliveryOptions (maxSize) ---------- */
$adoRows = fix('getAvailableDeliveryOptions.json', $fixDir);
$ado = \TopSoft4U\Connector\Methods\GetAvailableDeliveryOptions\GetAvailableDeliveryOptionsItem::FromData($adoRows[0]);
check('delivery.maxSizeX', $ado->maxSizeX === 60.0);
check('delivery.maxSizeY', $ado->maxSizeY === 40.0);
check('delivery.maxSizeZ', $ado->maxSizeZ === 30.0);

/* ---------- GetProductAttributes (from/to) ---------- */
$paRows = fix('getProductAttributes.json', $fixDir);
$paRange = \TopSoft4U\Connector\Methods\GetProductAttributes\GetProductAttributeItem::FromData($paRows[1]);
check('attribute.from', $paRange->from === '0');
check('attribute.to', $paRange->to === '1');

/* ---------- GetProductsQty (currency) ---------- */
$pq = \TopSoft4U\Connector\Methods\GetProductsQty\GetProductsQtyItem::FromData(fix('getProductsQty.json', $fixDir)[0]);
check('productsQty.currency', $pq->currency === 'PLN');
$pqReq = new \TopSoft4U\Connector\Methods\GetProductsQty\GetProductsQtyRequest();
$pqReq->ean = '123'; $pqReq->limit = 10;
check('productsQty.request ean+limit', $pqReq->getQueryParams() === ['ean' => '123', 'limit' => 10]);

/* ---------- GetSaleDocuments (saleId/saleDate/saleType) ---------- */
$sd = \TopSoft4U\Connector\Methods\GetSaleDocuments\GetSaleDocumentsItem::FromData(fix('getSaleDocuments.json', $fixDir)[0]);
check('doc.saleId', $sd->saleId === 12345);
check('doc.saleDate', $sd->saleDate === '2018-09-28 13:47:28');
check('doc.saleType', $sd->saleType === 0);

/* ---------- GetSalePositions (leadTime int) ---------- */
$sp = \TopSoft4U\Connector\Methods\GetSalePositions\GetSalePositionsItem::FromData(fix('getSalePositions.json', $fixDir)[0]);
check('position.leadTime int', $sp->leadTime === 3);

/* ---------- GetComplaints (pictures normalization) ---------- */
$compRows = fix('getComplaints.json', $fixDir);
check('complaint.pictures array', \TopSoft4U\Connector\Methods\GetComplaints\GetComplaintsItem::FromData($compRows[0])->pictures === ['https://example.com/pic1.png', 'https://example.com/pic2.png']);
$emptyPics = $compRows[1];
check('complaint.pictures empty-string -> []', \TopSoft4U\Connector\Methods\GetComplaints\GetComplaintsItem::FromData($emptyPics)->pictures === []);

/* ---------- GPSR ---------- */
$gpsrRows = fix('getGPSREntities.json', $fixDir);
$g = \TopSoft4U\Connector\Methods\GetGPSREntities\GetGPSREntitiesItem::FromData($gpsrRows[0]);
check('gpsr.country.iso', $g->country->iso === 'PL');
check('gpsr.country.id', $g->country->id === 171);
$gNull = \TopSoft4U\Connector\Methods\GetGPSREntities\GetGPSREntitiesItem::FromData($gpsrRows[1]);
check('gpsr.nullable email/url/phone', $gNull->email === null && $gNull->url === null && $gNull->phone === null);

/* ---------- Variants ---------- */
$pv = \TopSoft4U\Connector\Methods\GetProductVariants\GetProductVariantItem::FromData(fix('getProductVariants.json', $fixDir)[0]);
check('variant.type', $pv->type === 'variant');
check('variant.subItems count', count($pv->subItems) === 2);
check('variant.fullMatch', $pv->subItems[1]->fullMatch === true);

/* ---------- Sales / Shipments ---------- */
$salesItem = \TopSoft4U\Connector\Methods\GetSales\GetSalesItem::FromData(fix('getSales.json', $fixDir)[0]);
check('sales.mergedIds', $salesItem->mergedIds === [1, 2, 3]);
$shipItem = \TopSoft4U\Connector\Methods\GetShipments\GetShipmentsItem::FromData(fix('getShipments.json', $fixDir)[0]);
check('shipments.orderDocumentNames', $shipItem->orderDocumentNames === ['FV/1', 'FV/2']);

/* ---------- Pagination across all 7 paginated requests ---------- */
$paginated = [
    new \TopSoft4U\Connector\Methods\GetProducts\GetProductsRequest(),
    new \TopSoft4U\Connector\Methods\GetProductsQty\GetProductsQtyRequest(),
    new \TopSoft4U\Connector\Methods\GetProductCategories\GetProductCategoriesRequest(),
    new \TopSoft4U\Connector\Methods\GetCategoryAttributes\GetCategoryAttributesRequest(),
    new \TopSoft4U\Connector\Methods\GetSales\GetSalesRequest(),
    new \TopSoft4U\Connector\Methods\GetShipments\GetShipmentsRequest(),
    new \TopSoft4U\Connector\Methods\GetGPSREntities\GetGPSREntitiesRequest(),
];
foreach ($paginated as $i => $r) {
    $cls = get_class($r);
    $empty = $r->getQueryParams();
    check("$cls empty omits pagination", !isset($empty['limit']) && !isset($empty['page']));
    $r->limit = 100; $r->page = 3;
    $with = $r->getQueryParams();
    check("$cls appends limit+page", ($with['limit'] ?? null) === 100 && ($with['page'] ?? null) === 3);
}

/* ---------- Simple DTOs ---------- */
$ca = \TopSoft4U\Connector\Methods\GetCategoryAttributes\GetCategoryAttributesItem::FromData(fix('getCategoryAttributes.json', $fixDir)[0]);
check('categoryAttributes.categoryIds', $ca->categoryIds === [2116, 2117]);
$cr = (new \TopSoft4U\Connector\Methods\GetComplaintReasons\GetComplaintReasonsRequest())->formatData(fix('getComplaintReasons.json', $fixDir));
check('complaintReasons count', count($cr->items) === 2 && $cr->items[0]->name === 'Damaged');
$cs = (new \TopSoft4U\Connector\Methods\GetComplaintStatuses\GetComplaintStatusesRequest())->formatData(fix('getComplaintStatuses.json', $fixDir));
check('complaintStatuses', $cs->items[0]->name === 'Open');
$cto = \TopSoft4U\Connector\Methods\GetComplaintTypeOptions\GetComplaintTypeOptionsItem::FromData(fix('getComplaintTypeOptions.json', $fixDir)[1]);
check('complaintTypeOptions.disabled', $cto->disabled === true);
$pay = \TopSoft4U\Connector\Methods\GetPaymentTypes\GetPaymentTypesItem::FromData(fix('getPaymentTypes.json', $fixDir)[0]);
check('paymentTypes.logo', $pay->logo === 'paypal.png');
$st = \TopSoft4U\Connector\Methods\GetShipmentTypes\GetShipmentTypesItem::FromData(fix('getShipmentTypes.json', $fixDir)[0]);
check('shipmentTypes.maxWeight', $st->maxWeight === 30.0);
$pcat = \TopSoft4U\Connector\Methods\GetProductCategories\GetProductCategoryItem::FromData(fix('getProductCategories.json', $fixDir)[0]);
check('productCategories.fkParent', $pcat->fkParent === 2622);
$tree = \TopSoft4U\Connector\Methods\GetProductCategoryTree\GetProductCategoryTreeItem::FromData(fix('getProductCategoryTree.json', $fixDir)[0]);
check('categoryTree recursive', count($tree->children) === 1 && $tree->children[0]->id === 2116);

/* ---------- Result ---------- */
echo "\n";
if ($failures) {
    fwrite(STDERR, "\n" . count($failures) . " FAILURE(S):\n - " . implode("\n - ", $failures) . "\n");
    exit(1);
}
echo "All standalone checks passed.\n";
exit(0);
