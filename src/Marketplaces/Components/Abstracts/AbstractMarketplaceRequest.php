<?php

declare(strict_types=1);

namespace Marketplaces\Components\Abstracts;

use GuzzleHttp\Psr7\Request as HttpRequest;
use Marketplaces\Contracts\ConfigInterface;
use Marketplaces\Contracts\RequestInterface;
use Psr\Http\Message\RequestInterface as RequestContract;

abstract class AbstractMarketplaceRequest implements RequestInterface
{
    protected string $url;
    protected array $headers;
    protected array $parameters = [];

    public function __construct(
        protected ConfigInterface $config,
        protected string $method,
        protected string $path,
        protected array $body = [],
        protected string $httpVersion = '1.1',
    )
    {
        $this->url = $this->config->getApiEndpoint() . $this->getPathWithParameters();
        $this->headers = $this->config->getHttpHeaders();
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getHttpVersion(): string
    {
        return $this->httpVersion;
    }

    public function getBodyAsJson(): string
    {
        return json_encode($this->body);
    }

    /**
     * TODO move to separate factory
     * Make Psr-7 request instance.
     *
     * @return RequestContract
     */
    public function createHttpRequest(): RequestContract
    {
        return new HttpRequest(
            $this->getMethod(),
            $this->getUrl(),
            $this->getHeaders(),
            $this->getBodyAsJson(),
            $this->getHttpVersion(),
        );
    }

    public function setParameters(array $parameters): self
    {
        $this->parameters = $parameters;
        return $this;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function getPathWithParameters(): string
    {
        $path = $this->path;

        foreach ($this->parameters as $key => $value) {
            $path .= "$key";
        }

        return $path;
    }
}
