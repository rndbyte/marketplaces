<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Wildberries\Factories;

use InvalidArgumentException;
use Marketplaces\Contracts\FactoryInterface;
use Marketplaces\Modules\Wildberries\Config;
use Marketplaces\Components\Support\Validator;

class ConfigFactory implements FactoryInterface
{
    public function __construct(
        private string $apiKey,
        private string $apiEndpoint,
    )
    {
    }

    public static function new(
        string $apiKey,
        string $apiEndpoint = 'https://suppliers-api.wildberries.ru',
    ): self
    {
        return new self($apiKey, $apiEndpoint);
    }

    public function create(): Config
    {
        if (!Validator::validateUrl($this->apiEndpoint)) {
            throw new InvalidArgumentException("Provided URL is invalid: " . $this->apiEndpoint);
        }

        return new Config(
            $this->apiKey,
            $this->apiEndpoint,
        );
    }
}
