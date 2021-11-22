<?php

declare(strict_types=1);

namespace Marketplaces\Contracts;

interface MarketplaceRequestInterface
{
    public const POST = 'POST';
    public const GET = 'GET';
    public const UPDATE = 'UPDATED';
    public const DELETE = 'DELETE';
    public const METHODS = [
        self::POST,
        self::GET,
        self::UPDATE,
        self::DELETE,
    ];

    public function getUrl(): string;
    public function getBody(): array;
    public function getPath(): string;
    public function getMethod(): string;
    public function getHeaders(): array;
    public function getParameters(): array;
    public function getBodyAsJson(): string;
    public function getHttpVersion(): string;
    public function getPathWithParameters(): string;
    public function setParameters(array $parameters): self;
}
