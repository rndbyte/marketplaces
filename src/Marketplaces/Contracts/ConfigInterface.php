<?php

declare(strict_types=1);

namespace Marketplaces\Contracts;

interface ConfigInterface
{
    public function getClientId(): string;
    public function getAccessKey(): string;
    public function getHttpHeaders(): array;
    public function getApiEndpoint(): string;
}
