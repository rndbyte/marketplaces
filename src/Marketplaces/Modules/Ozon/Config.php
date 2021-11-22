<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon;

use Marketplaces\Contracts\ConfigInterface;

class Config implements ConfigInterface
{
    public function __construct(
        private string $apiKey,
        private string $clientId,
        private string $apiEndpoint = 'https://api-seller.ozon.ru',
    )
    {
    }

    public function getAccessKey(): string
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
            'Api-Key' => $this->getAccessKey(),
            'Content-Type' => 'application/json',
        ];
    }
}
