<?php
declare(strict_types=1);

namespace TopSoft4U\Connector;

use InvalidArgumentException;
use TopSoft4U\Connector\Abstracts\BaseRequest;
use TopSoft4U\Connector\Utils\IdList;
use TopSoft4U\Connector\Utils\Language;
use TopSoft4U\Connector\Utils\OutputType;

class PQApiClient
{
    private ?Language $lang = null;
    protected string $baseUrl;
    protected string $apiKey;
    private OutputType $outputFormat;
    private bool $testMode = false;

    public function __construct(string $baseUrl, string $apiKey)
    {
        if (!filter_var($baseUrl, FILTER_VALIDATE_URL))
            throw new InvalidArgumentException("Invalid base URL");

        $this->baseUrl = $baseUrl;

        if (empty($apiKey))
            throw new InvalidArgumentException("API key cannot be empty");

        $this->apiKey = $apiKey;
        $this->outputFormat = OutputType::JSON();
    }

    public function setLanguage(Language $lang): void
    {
        $this->lang = $lang;
    }

    public function setOutputFormat(OutputType $outputFormat): void
    {
        $this->outputFormat = $outputFormat;
    }

    /**
     * This method is used to enable or disable test mode.
     * Test mode is only used in POST requests.
     * When enabled, it will not perform any changes in the system, but will return a response as if the changes were made.
     * That also means that you will not be able to fetch, for example, an order details after creating it in test mode - because it was not created in the system.
     */
    public function setTestMode(bool $testMode): void
    {
        $this->testMode = $testMode;
    }

    /**
     * @param array<string, mixed> $values
     * @return array<string, mixed>
     */
    private function prepareOutputValues(array $values): array
    {
        foreach ($values as $key => $value) {
            if ($value === null) {
                unset($values[$key]);
                continue;
            }

            if (is_array($value)) {
                if (empty($value))
                    continue;

                // Check if the array is associative
                if (array_keys($value) !== range(0, count($value) - 1)) {
                    /** @var array<string, mixed> $value */
                    $values[$key] = $this->prepareOutputValues($value);
                    continue;
                }

                $firstValue = reset($value);
                if (is_array($firstValue)) {
                    /** @var array<string, mixed> $value */
                    $values[$key] = $this->prepareOutputValues($value);
                } else {
                    /** @var array<int> $value */
                    $intValues = array_map('intval', $value);
                    // Flat scalar list -> comma-joined via IdList, then stringified below.
                    $value = new IdList($intValues);
                    $values[$key] = $value;
                }
            }

            if (is_object($value) && method_exists($value, "__toString")) {
                $values[$key] = $value->__toString();
            }
        }

        return $values;
    }

    /**
     * @return array<string, mixed>
     */
    protected function prepareQueryParams(BaseRequest $method): array
    {
        $queryParams = $method->getQueryParams();
        $queryParams['key'] = $this->apiKey;
        if ($this->lang) $queryParams['lang'] = (string)$this->lang;

        $queryParams = $this->prepareOutputValues($queryParams);

        if ($method->usesBody() && $this->testMode)
            $queryParams["test"] = true;

        return $queryParams;
    }

    protected function getUrl(BaseRequest $method): string
    {
        $url = $this->baseUrl . $method->getUrl() . "." . $this->outputFormat;

        $queryParams = $this->prepareQueryParams($method);
        $queryString = http_build_query($queryParams);
        if ($queryString)
            $url .= "?" . $queryString;

        return $url;
    }

    /**
     * This method is used to execute a method and get the raw response and status code.
     *
     * @param \TopSoft4U\Connector\Abstracts\BaseRequest $method
     *
     * @return array{output: string, statusCode: int}
     */
    public function executeMethod(BaseRequest $method): array
    {
        $url = $this->getUrl($method);

        $methodType = $method->getMethodType();
        $bodyData = $method->getBodyData();

        $curl = curl_init();
        /** @var non-empty-string $url */
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        /** @var non-empty-string $methodType */
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $methodType);

        if ($method->usesBody()) {
            /** @var array<string, mixed> $bodyData */
            $bodyData = json_decode((string)json_encode($bodyData), true) ?? [];
            $bodyData = $this->prepareOutputValues($bodyData);

            if ($files = $method->getFiles())
                $formData = array_merge($bodyData, $files);
            else {
                $formData = http_build_query($bodyData);

                // Prettify the form data for logging
//                $formPretty = str_replace("&", "\n", $formData);
//                $formPretty = str_replace("%5B", "[", $formPretty);
//                $formPretty = str_replace("%5D", "]", $formPretty);
            }

            curl_setopt($curl, CURLOPT_POSTFIELDS, $formData);
        }

        /** @var string|false $output */
        $output = curl_exec($curl);
        $statusCode = (int)curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if (!$statusCode) {
            $error = curl_error($curl);
            throw new \Exception("Failed to get response from the server. Error: " . $error);
        }

        curl_close($curl);

        return [
            "output"     => is_string($output) ? $output : '',
            "statusCode" => $statusCode,
        ];
    }

    /**
     * This is the main method to send a request to the PQ API.
     *
     * If you want, you can use executeMethod to get a raw response and status code and handle it yourself.
     *
     * @throws \TopSoft4U\Connector\PQApiException
     * @throws \Exception
     */
    /**
     * @return array<string, mixed>|null
     */
    public function sendRequest(BaseRequest $method)
    {
        $response = $this->executeMethod($method);
        $statusCode = $response["statusCode"];

        if ($statusCode === 204)
            return null;

        if ((string)$this->outputFormat !== (string)OutputType::JSON())
            throw new \Exception("Unsupported output format. Only JSON is supported. If you want to use another format, use executeMethod instead and handle the response yourself.");

        $data = json_decode($response["output"], true);
        if ($statusCode >= 400) {
            $lines = [];
            $levels = ["danger", "warning", "info"];
            $messages = is_array($data) && is_array($data["messages"] ?? null) ? $data["messages"] : [];
            foreach ($messages as $level => $messageList) {
                if (!in_array($level, $levels, true))
                    continue;

                if (!is_array($messageList))
                    continue;

                foreach ($messageList as $message) {
                    if (is_string($message))
                        $lines[] = $message;
                }
            }

            throw new PQApiException($statusCode, implode("\n", $lines));
        }

        if (!is_array($data)) {
            return null;
        }

        /** @var array<string, mixed> $data */
        return $data;
    }
}
