# API Connector for websites using ProQoS backend services

Type-safe PHP connector for websites using ProQoS backend services. 

## Requirements
- Minimum PHP Version: 7.4
- Dependencies: ext-curl, ext-json

## Application
This connector can be used for the following websites:

|                                          Website | 📕 Documentation                                |
|----------------------------------------------------:|:------------------------------------------------|
|                   [e-hedo.pl](https://e-hedo.pl) | [📕 LINK](https://e-hedo.pl/apidocs)            |
|                 [magboss.pl](https://magboss.pl) | [📕 LINK](https://magboss.pl/apidocs)           |
| [hedo-electro.com](https://b2b.hedo-electro.com) | [📕 LINK](https://b2b.hedo-electro.com/apidocs) |
|           [hedo-pets.com](https://hedo-pets.com) | [📕 LINK](https://hedo-pets.com/apidocs)        |

**Note:** For each website, you need a separate API key. To get one, please use the contact form on specific website.

## Installation
You can install the connector via Composer using the following command:

```bash
composer require topsoft4u/api-connector
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

## Releasing a new version
1. Update the version in the `composer.json` file with `bash /scripts/bump_version.sh`.
2. Finish the release with `bash /scripts/commit_tag_push.sh` - which will create a new tag and push it to the repository.
