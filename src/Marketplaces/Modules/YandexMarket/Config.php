<?php

declare(strict_types=1);

namespace Marketplaces\Modules\YandexMarket;

use Marketplaces\Contracts\ConfigInterface;

class Config implements ConfigInterface
{
    public function __construct(
        private string $oauthToken,
        private string $clientId,
        private string $apiEndpoint,
        private string $campaignId,
    )
    {
    }

    public function getApiKey(): string
    {
        return $this->oauthToken; // AgAAAABBVbY3AAZnNNG85UGKw0ybrWEr1pUVVC4
    }

    public function getClientId(): string
    {
        return $this->clientId; // ef9653aed5d74c209e91e834f98db089
    }

    public function getHttpHeaders(): array
    {
        return [
            'Authorization' => 'OAuth oauth_token=" '. $this->getApiKey() .' ", oauth_client_id="'. $this->getClientId() .'"',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    public function getSecretToken(): string
    {
        return $this->campaignId;
    }

    public function getApiEndpoint(): string
    {
        return $this->apiEndpoint;
    }
}
