# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.1.0] - 2026-07-07

### Added
- `PaginatedRequest` abstract base class. The following GET endpoints are now
  paginated and accept optional `limit` (server caps at 1000) and `page` (>= 1)
  parameters, without any client-side enforcement:
  - `GetCategoryAttributesRequest`
  - `GetGPSREntitiesRequest`
  - `GetProductCategoriesRequest`
  - `GetProductsRequest`
  - `GetProductsQtyRequest`
  - `GetSalesRequest`
  - `GetShipmentsRequest`
- `GetProductsShipmentBox` DTO for the new `shipmentboxes` array on
  `getProducts` (replaces the deprecated top-level `size_x`/`size_y`/`size_z`).
- `GetProductsItem`: `currency`, `promotionEnabled`, `brand`, `shipmentBoxes`
  fields.
- `GetProductsRequest`: `ean`, `longestEdgeAbove`/`longestEdgeBelow`,
  `weightGrossAbove`/`weightGrossBelow`, `userPriceNetAbove`/`userPriceNetBelow`,
  `userPriceGrossAbove`/`userPriceGrossBelow` query parameters.
- `GetProductsQtyRequest`: `ean` query parameter.
- `GetProductsQtyItem`: `currency` field.
- `GetAccountDataResponse`: `currency` field.
- `GetAvailableDeliveryOptionsItem`: `maxSizeX`, `maxSizeY`, `maxSizeZ` fields.
- `GetProductAttributeItem`: `from`, `to` range fields.
- `GetSaleResponse`: `email` field (receiver email).
- `GetSaleDocumentsItem`: `saleId`, `saleDate`, `saleType` fields.
- PHPUnit test suite with fixtures covering every DTO.

### Changed
- **BREAKING**: `GetSaleResponse::$shipmentCountry` renamed to `$shipmentPrice`.
  The property was always mapped from the `shipmentprice` response key and held
  the net shipment price; the old name was incorrect.
- `CreateComplaintRequest::getBodyData()` now sends the quantity under the
  `qty` key (was `quantity`), matching the documented API field name.
- `GetProductMediaItem` no longer maps the non-existent `id` and `medianame`
  response keys. It now exposes `fkProduct` (from `fkproduct`) alongside the
  existing `name`, `created`, `src`, `ext`, `size` fields.
- `GetComplaintsItem::$pictures` is now normalized to an array regardless of
  whether the API returns `null`, an empty string, a single string, or an array.
- `GetProductMediaResponse` PHPDoc corrected (`GetProductVariantItem[]` ->
  `GetProductMediaItem[]`).
- `GetProductsItem::$sizeX`/`$sizeY`/`$sizeZ` marked `@deprecated` in favour of
  `$shipmentBoxes`.
- Removed `GetAvailableDeliveryOptionsPayment::$priceExplanation` and its
  mapping — the field is not part of the documented response and reading it
  triggered a PHP "undefined array key" notice.

### Notes
- `GetProductVariantSubItem::$slug` remains (read with `?? null`); it is not in
  the public docs but is emitted by the API and harmless.

### Tooling
- `declare(strict_types=1)` added to every `src/` file; the package no longer
  relies on PHP's silent type coercion. (The level-10 PHPStan hardening made
  this safe to adopt consistently.)
- Dedicated multi-version test environment: a parametric `Dockerfile` and
  `docker-compose.yml` matrix covering PHP 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 and 8.5.
  Run one version with `docker compose run --rm php83`, all of them with
  `bash scripts/test.sh`.
- Added `phpstan/phpstan ^2.0` to `require-dev` with a `phpstan.neon`
  config at the maximum level (10); analysis runs as part of every container
  and CI run, with **no baseline and no ignores** — the whole `src/` tree passes
  clean at level 10.
- GitHub Actions CI (`.github/workflows/tests.yml`) runs the PHPUnit suite and
  PHPStan across the full PHP matrix on every push and pull request.
- Fixed three issues surfaced by static analysis: `Date::checkdate` now casts
  its arguments to `int`; `IdList::jsonSerialize()` and
  `CreateSaleOwnLabelItem::jsonSerialize()` now declare covariant return types.

## [1.0.1]

- GPSR methods and responses.
- `hedo-electro` host replaced with `onesto-energy`.
- Removed unsupported `fit1-3` query parameters.
- Several schema updates + value check for `OutputType`.
- Several properties/functions marked `protected` for easier extension.
