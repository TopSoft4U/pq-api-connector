<?php

namespace TopSoft4U\Connector;

use InvalidArgumentException;
use TopSoft4U\Connector\Abstracts\BaseMethod;
use TopSoft4U\Connector\Utils\Language;

class PQApiClient
{
    private ?Language $lang = null;
    private string $baseUrl;
    private string $apiKey;

    public function __construct(string $baseUrl, string $apiKey)
    {
        if (!filter_var($baseUrl, FILTER_VALIDATE_URL))
            throw new InvalidArgumentException("Invalid base URL");

        $this->baseUrl = $baseUrl;

        if (empty($apiKey))
            throw new InvalidArgumentException("API key cannot be empty");

        $this->apiKey = $apiKey;
    }

    public function setLanguage(Language $lang)
    {
        $this->lang = $lang;
    }

    /**
     * @throws \TopSoft4U\Connector\PQApiException
     */
    public function sendRequest(BaseMethod $method)
    {
        $url = $this->baseUrl . $method->getUrl() . ".json";

        $queryParams = $method->getQueryParams();
        $queryParams['key'] = $this->apiKey;
        if ($this->lang) $queryParams['lang'] = (string)$this->lang;

        $methodType = $method->getMethodType();
        $bodyData = $method->getBodyData();

        $qParamsString = http_build_query($queryParams);
        if ($qParamsString)
            $url .= "?" . $qParamsString;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $methodType);

        $methodTypesWithBody = ["POST", "PUT", "PATCH"];
        if (in_array($methodType, $methodTypesWithBody)) {
            $formData = http_build_query($bodyData);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $formData);
        }

        $response = curl_exec($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $data = json_decode($response, true);

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

        if ($statusCode === 204)
            return null;

        return $data;
    }
}
