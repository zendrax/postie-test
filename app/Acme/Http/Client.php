<?php

namespace App\Acme\Http;

use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\ResponseInterface;

class Client
{
    /** @var \GuzzleHttp\Client guzzleClient */
    protected $guzzleClient;

    /**
     * Client constructor.
     *
     * @param \GuzzleHttp\Client $guzzleClient
     */
    public function __construct(GuzzleClient $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }

    public function get(string $uri): ResponseInterface
    {
        return $this->guzzleClient->get($uri);
    }
}
