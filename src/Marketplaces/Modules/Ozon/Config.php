<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon;

use Marketplaces\Contracts\ConfigInterface as ConfigInterface;

class Config implements ConfigInterface
{
    public function __construct(
        private string $apiKey,
        private string $clientId,
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
        return $this->clientId;
    }

    public function getApiEndpoint(): string
    {
        return $this->apiEndpoint;
    }

    public function getHttpHeaders(): array
    {
        return [
            'Client-Id' => $this->getClientId(),
            'Api-Key' => $this->getApiKey(),
            'Content-Type' => 'application/json',
        ];
    }

    public function getSecretToken(): string
    {
        return '';
    }
}
