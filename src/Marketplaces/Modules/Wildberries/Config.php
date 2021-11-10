<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Wildberries;

use Marketplaces\Contracts\ConfigInterface;

class Config implements ConfigInterface
{
    public function __construct(
        private string $apiKey,
        private string $apiEndpoint,
    )
    {
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getClientId(): string
    {
        return '';
    }

    public function getHttpHeaders(): array
    {
        return [
            'Authorization' => $this->getApiKey(),
            'Content-Type' => 'application/json',
        ];
    }

    public function getSecretToken(): string
    {
        return '';
    }

    public function getApiEndpoint(): string
    {
        return $this->apiEndpoint;
    }
}
