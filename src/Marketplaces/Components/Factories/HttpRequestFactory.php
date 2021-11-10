<?php

declare(strict_types=1);

namespace Marketplaces\Components\Factories;

use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Psr7\Request as HttpRequest;
use Marketplaces\Contracts\FactoryInterface;
use Marketplaces\Contracts\MarketplaceRequestInterface;

class HttpRequestFactory implements FactoryInterface
{
    public function __construct(private MarketplaceRequestInterface $marketplaceRequest)
    {
    }

    /**
     * Make Psr-7 request instance.
     *
     * @return RequestInterface
     */
    public function create(): RequestInterface
    {
        return new HttpRequest(
            $this->marketplaceRequest->getMethod(),
            $this->marketplaceRequest->getUrl(),
            $this->marketplaceRequest->getHeaders(),
            $this->marketplaceRequest->getBodyAsJson(),
            $this->marketplaceRequest->getHttpVersion(),
        );
    }
}
