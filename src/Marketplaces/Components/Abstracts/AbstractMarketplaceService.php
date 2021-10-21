<?php

declare(strict_types=1);

namespace Marketplaces\Components\Abstracts;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;
use Marketplaces\Contracts\{ConfigInterface, ServiceInterface, RequestInterface};
use Marketplaces\Components\Exceptions\MarketplaceException;
use Psr\Http\Client\{ClientInterface, ClientExceptionInterface};

abstract class AbstractMarketplaceService implements ServiceInterface
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
    public function sendRequest(RequestInterface $request): string
    {
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
