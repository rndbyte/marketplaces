<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Factories;

use InvalidArgumentException;
use Marketplaces\Modules\Ozon\Config;
use Marketplaces\Contracts\FactoryInterface;
use Marketplaces\Components\Support\Validator;

class ConfigFactory implements FactoryInterface
{
    public static function new(): self
    {
        return new self();
    }

    public function create(
        string $apiKey = null,
        string $clientId = null,
        string $apiEndpoint = null,
    ): Config
    {
        if (isset($apiEndpoint) && !Validator::validateUrl($apiEndpoint)) {
            throw new InvalidArgumentException("Provided URL is invalid: " . $apiEndpoint);
        }

        return new Config(
            $apiKey ?? '0296d4f2-70a1-4c09-b507-904fd05567b9',
            $clientId ?? '836',
            $apiEndpoint ?? 'https://cb-api.ozonru.me',
        );
    }
}
