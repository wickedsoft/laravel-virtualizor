<?php

namespace wickedsoft\Virtualizor\HttpClient;

class HttpClient implements HttpClientInterface
{
    /** @var \GuzzleHttp\Client */
    protected $client;

    /** @var array */
    protected $options = [];

    /**
     * @return \GuzzleHttp\Client
     */
    public function getClient()
    {
        if (!isset($this->client)) {
            $this->client = new \GuzzleHttp\Client(config('virtualizor.client_options'));

            return $this->client;
        }

        return $this->client;
    }

    /**
     * @param $client
     * @return \GuzzleHttp\Client
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this->client;
    }

    /**
     * @param array $body
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($path="", $query = [])
    {
        $response = $this->getClient()->request(
            'GET',
            config('virtualizor.sites.default.url').$path,
            [
                'query' => $query
            ]
        );
        return json_decode((string)$response->getBody(), true);
    }

    /**
     * @param array $body
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post($path="", $body = [])
    {
        $response = $this->getClient()->request(
            'POST',
            config('virtualizor.sites.default.url').$path,
            [
                'form_params' => $body
            ]
        );
        return json_decode((string)$response->getBody(), true);
    }

    /**
     * @param array $body
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function put($path="", $body = [])
    {
        $response = $this->getClient()->request(
            'PUT',
            config('virtualizor.sites.default.url').$path,
            [
                'form_params' => $body
            ]
        );
        return json_decode((string)$response->getBody(), true);
    }

    /**
     * @param array $body
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($path="", $body = [])
    {
        $response = $this->getClient()->request(
            'DELETE',
            config('virtualizor.sites.default.url').$path,
            [
                'form_params' => $body
            ]
        );
        return json_decode((string)$response->getBody(), true);
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->options = array_merge($this->options, $options);
    }
}
