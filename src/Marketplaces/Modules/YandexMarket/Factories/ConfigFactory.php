<?php

declare(strict_types=1);

namespace Marketplaces\Modules\YandexMarket\Factories;

use InvalidArgumentException;
use Marketplaces\Contracts\FactoryInterface;
use Marketplaces\Modules\YandexMarket\Config;
use Marketplaces\Components\Support\Validator;

class ConfigFactory implements FactoryInterface
{
    public static function new(): self
    {
        return new self();
    }

    public function create(
        string $oauthToken = null,
        string $clientId = null,
        string $apiEndpoint = null,
        string $campaignId = null,
    ): Config
    {
        if (is_null($oauthToken) || is_null($clientId) || is_null($apiEndpoint) || is_null($campaignId)) {
            throw new InvalidArgumentException('Not provided all required config data!');
        }

        if (!Validator::validateUrl($apiEndpoint)) {
            throw new InvalidArgumentException("Provided URL is invalid: " . $apiEndpoint);
        }

        return new Config(
            $oauthToken,
            $clientId,
            $apiEndpoint,
            $campaignId,
        );
    }
}
