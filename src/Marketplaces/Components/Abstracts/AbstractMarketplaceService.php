<?php

declare(strict_types=1);

namespace Marketplaces\Components\Abstracts;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;
use Marketplaces\Contracts\{ConfigInterface, MarketplaceServiceInterface, MarketplaceRequestInterface};
use Marketplaces\Components\Exceptions\MarketplaceException;
use Psr\Http\Client\{ClientInterface, ClientExceptionInterface};

/**
 * Class AbstractMarketplaceService
 *
 * Responsibility of this class is to send http requests via http client.
 *
 * So workflow of methods will be like:
 *     1) Prepare marketplace request (create instance, insert data);
 *     2) Create http request from marketplace request (via factory);
 *     3) Send http request;
 *     4) Return marketplace response from http response or throw corresponding exception (via factory);
 *
 * @package Marketplaces\Components\Abstracts
 */
abstract class AbstractMarketplaceService implements MarketplaceServiceInterface
{
    public function __construct(
        protected ConfigInterface $config,
        protected LoggerInterface $logger,
        protected ClientInterface $httpClient,
    )
    {
    }

    /**
     * @throws MarketplaceException
     * @throws ClientExceptionInterface
     */
    public function sendRequest(MarketplaceRequestInterface $request): string
    {
        // TODO use factory for http request
        $response = $this->httpClient->sendRequest($request->createHttpRequest());
        return $this->getResponseResultOrThrowException($response);
    }

    /**
     * @param ResponseInterface $response
     * @return string
     * @throws MarketplaceException
     */
    abstract protected function getResponseResultOrThrowException(ResponseInterface $response): string;
}
