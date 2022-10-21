<?php

namespace BlsaCn\ParseVideoUrl\parse\tools;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RuntimeException;

trait HttpRequest
{
    private $options = [
        'timeout' => 5.0,
        'verify' => false,
    ];

    /**
     * 发送get请求
     *
     * @param string $url
     * @param array  $query
     * @param array  $headers
     *
     * @return string
     * @throws GuzzleException
     */
    public function get(string $url, array $query = [], array $headers = []): string
    {
        $params = [
            'headers' => $headers,
            'query' => $query,
        ];

        return $this->client()->get($url, $params)->getBody()->getContents();
    }

    private function client(): Client
    {
        return new Client($this->options);
    }

    /**
     * 获取重定向后的url
     *
     * @param string $url
     *
     * @return string
     */
    public function redirect(string $url): string
    {
        try {
            $response = $this->client()
                ->request('GET', $url, [
                    'allow_redirects' => false
                ]);
        } catch (GuzzleException $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode());
        }

        if (substr($response->getStatusCode(), 0, 2) == 30) {
            return $response->getHeaderLine('Location');
        }

        return $url;
    }
}
