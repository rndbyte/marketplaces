<?php

declare(strict_types=1);

namespace Marketplaces\Modules\YandexMarket;

use Marketplaces\Contracts\ConfigInterface;

class Config implements ConfigInterface
{
    public function __construct(
        private string $oauthToken,
        private string $clientId,
        private string $apiEndpoint = 'https://api.partner.market.yandex.ru',
    )
    {
    }

    public function getAccessKey(): string
    {
        return $this->oauthToken;
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
            'Authorization' => 'OAuth oauth_token=" '. $this->getAccessKey() .' ", oauth_client_id="'. $this->getClientId() .'"',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }
}
