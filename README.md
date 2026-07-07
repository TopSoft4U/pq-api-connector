# API Connector for websites using ProQoS backend services

Type-safe PHP connector for websites using ProQoS backend services. 

## Requirements
- Minimum PHP Version: 7.4
- Dependencies: ext-curl, ext-json

## Application
This connector can be used for the following websites:

|                                                        Website | 📕 Documentation                                |
|---------------------------------------------------------------:|:------------------------------------------------|
|                                 [e-hedo.pl](https://e-hedo.pl) | [📕 LINK](https://e-hedo.pl/apidocs)            |
|                               [magboss.pl](https://magboss.pl) | [📕 LINK](https://magboss.pl/apidocs)           |
|           [b2b.onesto-energy.pl](https://b2b.onesto-energy.pl) | [📕 LINK](https://b2b.onesto-energy.pl/apidocs) |
|                         [hedo-pets.com](https://hedo-pets.com) | [📕 LINK](https://hedo-pets.com/apidocs)        |

**Note:** For each website, you need a separate API key. To get one, please use the contact form on specific website.

## Installation
You can install the connector via Composer using the following command:

```bash
composer require topsoft4u/pq-api-connector
```

## Usage

Each method has its own example in the [examples](example) directory.

For explanation of each method, please refer to the API documentation links mentioned earlier.

## Functions
- Type-safe methods and responses with null-type support.
- Client (connector) validations before sending requests.
- Error handling with exceptions.
- Option to change output language.
- Option to change the output format (JSON/XML).
- You can fetch the JSON/XML file without parsing (usable for testing).
- Test mode for POST methods (sends data to the server, but it's not saved).
- Optional `limit` / `page` pagination on list endpoints (see `PaginatedRequest`).

## Testing

A PHPUnit test suite covers every response DTO. Fixtures under `tests/Fixtures/`
mirror the real (lowercase-keyed) API response shapes.

The full matrix (PHP 7.4 → 8.5) runs in isolated, dedicated containers — no host
PHP or shared `vendor/`:

```bash
# One version
docker compose run --rm php83

# The whole matrix
bash scripts/test.sh
```

To run locally with your own PHP (requires ext-curl, ext-dom, ext-mbstring,
ext-xml, ext-xmlwriter):

```bash
composer install
vendor/bin/phpunit --no-coverage
vendor/bin/phpstan analyse   # level 10, no baseline/ignores
```

A standalone runner that needs neither PHPUnit nor the analysis extensions is
also available, useful for quick smoke checks:

```bash
php tests/verify_standalone.php
```

CI runs the same matrix on every push and pull request
(see `.github/workflows/tests.yml`).

## Releasing a new version
1. Update the version in the `composer.json` file with `bash /scripts/bump_version.sh`.
2. Finish the release with `bash /scripts/commit_tag_push.sh` - which will create a new tag and push it to the repository.
