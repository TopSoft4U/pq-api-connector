<?php

namespace TopSoft4U\Connector;

use InvalidArgumentException;
use TopSoft4U\Connector\Abstracts\BaseMethod;
use TopSoft4U\Connector\Utils\Language;
use TopSoft4U\Connector\Utils\OutputType;

class PQApiClient
{
    private ?Language $lang = null;
    private string $baseUrl;
    private string $apiKey;
    private OutputType $outputFormat;

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

    private function prepareQueryParams(array $queryParams): array
    {
        $queryParams['key'] = $this->apiKey;
        if ($this->lang) $queryParams['lang'] = (string)$this->lang;

        foreach ($queryParams as $key => $value) {
            if ($value === null) {
                unset($queryParams[$key]);
                continue;
            }

            if (is_object($value) && method_exists($value, "__toString"))
                $queryParams[$key] = (string)$value;
        }

        return $queryParams;
    }

    private function getUrl(BaseMethod $method): string
    {
        $url = $this->baseUrl . $method->getUrl() . "." . $this->outputFormat;

        $queryParams = $this->prepareQueryParams($method->getQueryParams());
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
     * @return array
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

        $methodTypesWithBody = ["POST", "PUT", "PATCH"];
        if (in_array($methodType, $methodTypesWithBody)) {
            $formData = http_build_query($bodyData);
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

        if ((string) $this->outputFormat !== (string) OutputType::JSON())
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
