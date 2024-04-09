<?php

namespace TopSoft4U\Connector;

use InvalidArgumentException;
use TopSoft4U\Connector\Abstracts\BaseMethod;
use TopSoft4U\Connector\Utils\IdList;
use TopSoft4U\Connector\Utils\Language;
use TopSoft4U\Connector\Utils\OutputType;

class PQApiClient
{
    private ?Language $lang = null;
    private string $baseUrl;
    private string $apiKey;
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

    public function setLanguage(Language $lang)
    {
        $this->lang = $lang;
    }

    public function setOutputFormat(OutputType $outputFormat)
    {
        $this->outputFormat = $outputFormat;
    }

    /**
     * This method is used to enable or disable test mode.
     * Test mode is only used in POST requests.
     * When enabled, it will not perform any changes in the system, but will return a response as if the changes were made.
     * That also means that you will not be able to fetch, for example, an order details after creating it in test mode - because it was not created in the system.
     *
     * @param bool $testMode
     *
     * @return void
     */
    public function setTestMode(bool $testMode)
    {
        $this->testMode = $testMode;
    }

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
                    $values[$key] = $this->prepareOutputValues($value);
                    continue;
                }

                $firstValue = reset($value);
                if (is_array($firstValue))
                    $values[$key] = $this->prepareOutputValues($value);
                else
                    $value = new IdList($value);
            }

            if (is_object($value) && method_exists($value, "__toString"))
                $values[$key] = (string)$value;
        }

        return $values;
    }

    private function prepareQueryParams(BaseMethod $method): array
    {
        $queryParams = $method->getQueryParams();
        $queryParams['key'] = $this->apiKey;
        if ($this->lang) $queryParams['lang'] = (string)$this->lang;

        $queryParams = $this->prepareOutputValues($queryParams);

        if ($method->usesBody() && $this->testMode)
            $queryParams["test"] = true;

        return $queryParams;
    }

    private function getUrl(BaseMethod $method): string
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
     * @param \TopSoft4U\Connector\Abstracts\BaseMethod $method
     *
     * @return array{output: string, statusCode: int}
     */
    public function executeMethod(BaseMethod $method): array
    {
        $url = $this->getUrl($method);

        $methodType = $method->getMethodType();
        $bodyData = $method->getBodyData();

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $methodType);

        if ($method->usesBody()) {
            $bodyData = json_decode(json_encode($bodyData), true);
            $bodyData = $this->prepareOutputValues($bodyData);
            $formData = http_build_query($bodyData);

            // Prettify the form data for logging
            $formPretty = str_replace("&", "\n", $formData);
            $formPretty = str_replace("%5B", "[", $formPretty);
            $formPretty = str_replace("%5D", "]", $formPretty);

            curl_setopt($curl, CURLOPT_POSTFIELDS, $formData);
        }

        $output = curl_exec($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return [
            "output"     => $output,
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
    public function sendRequest(BaseMethod $method)
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
            foreach ($data["messages"] as $level => $messages) {
                if (!in_array($level, $levels))
                    continue;

                $lines = array_merge($lines, $messages);
            }

            throw new PQApiException($statusCode, implode("\n", $lines));
        }

        return $data;
    }
}
