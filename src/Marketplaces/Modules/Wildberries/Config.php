<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Wildberries;

use Marketplaces\Contracts\ConfigInterface;

class Config implements ConfigInterface
{
    public function __construct(
        private string $apiKey,
        private string $apiEndpoint = 'https://suppliers-api.wildberries.ru',
    )
    {
    }

    public function getAccessKey(): string
    {
        return $this->apiKey;
    }

    public function getClientId(): string
    {
        return '';
    }

    public function getApiEndpoint(): string
    {
        return $this->apiEndpoint;
    }

    public function getHttpHeaders(): array
    {
        return [
            'Authorization' => $this->getAccessKey(),
            'Content-Type' => 'application/json',
        ];
    }
}
