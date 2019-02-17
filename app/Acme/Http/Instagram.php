<?php

namespace App\Acme\Http;

class Instagram
{
    protected const BASE_URL = 'https://api.instagram.com/v1';

    /** @var \App\Acme\Http\Client client */
    protected $client;

    /**
     * Instagram constructor.
     *
     * @param \App\Acme\Http\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get information about the owner of the access_token.
     *
     * @param string $token
     * @return array
     */
    public function user(string $token): array
    {
        return $this->getResponseData($this->fullUrl('/users/self', $token));
    }

    /**
     * Get the most recent media published by the owner of the access_token.
     *
     * @param string $token
     * @return array
     */
    public function media(string $token): array
    {
        $url = $this->fullUrl('/users/self/media/recent', $token);
        $url .= '&count=6';

        return $this->getResponseData($url);
    }

    protected function getResponseData(string $url): array
    {
        $response = $this->client->get($url);
        $body = (string)$response->getBody();
        $decode = json_decode($body, $makeAssocArray = true);

        return $decode['data'] ?? [];
    }

    protected function fullUrl(string $endpoint, string $token): string
    {
        return vsprintf('%s%s?access_token=%s', [
            self::BASE_URL,
            $endpoint,
            $token,
        ]);
    }
}
