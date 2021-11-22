<?php

declare(strict_types=1);

namespace Marketplaces\Components\Abstracts;

use stdClass;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use Marketplaces\Components\Factories\HttpRequestFactory;
use Marketplaces\Components\Exceptions\MarketplaceException;
use Psr\Http\Client\{ClientInterface, ClientExceptionInterface};
use Marketplaces\Contracts\{ConfigInterface, MarketplaceServiceInterface, MarketplaceRequestInterface};

/**
 * Class AbstractMarketplaceService
 *
 * Responsibility of this class is to send http requests via http client.
 *
 * @package Marketplaces\Components\Abstracts
 */
abstract class AbstractMarketplaceService implements MarketplaceServiceInterface
{
    public function __construct(
        protected ConfigInterface $config,
        protected ClientInterface $httpClient,
    )
    {
    }

    /**
     * Send request to marketplace.
     *
     * @param MarketplaceRequestInterface $request
     * @return ResponseInterface
     * @throws MarketplaceException
     */
    public function sendRequest(MarketplaceRequestInterface $request): ResponseInterface
    {
        try {
            return $this->httpClient->sendRequest((new HttpRequestFactory($request))->create());
        } catch (ClientExceptionInterface $e) {
            throw new MarketplaceException(
                'Service responded with error: ' . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * Validate http response.
     *
     * @param ResponseInterface $response
     * @return bool
     */
    protected function isValidResponse(ResponseInterface $response): bool
    {
        return $response->getStatusCode() < 400;
    }

    /**
     * Decode json string to object.
     *
     * @param string $responseBodyContent
     * @return stdClass
     * @throws MarketplaceException
     */
    protected function extractResponseJsonContent(string $responseBodyContent): stdClass
    {
        try {
            return json_decode($responseBodyContent, false, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new MarketplaceException(
                'Invalid json string: ' . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * Return content of http response or throw corresponding marketplace exception.
     *
     * @param ResponseInterface $response
     * @return stdClass
     */
    abstract protected function getResponseContentOrThrowException(ResponseInterface $response): stdClass;
}
