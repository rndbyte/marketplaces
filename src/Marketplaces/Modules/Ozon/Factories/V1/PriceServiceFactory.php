<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Factories\V1;

use InvalidArgumentException;
use Psr\Http\Client\ClientInterface;
use Marketplaces\Modules\Ozon\Config;
use Marketplaces\Contracts\FactoryInterface;
use Marketplaces\Components\Support\Validator;
use Marketplaces\Modules\Ozon\Services\V1\PriceService;

class PriceServiceFactory implements FactoryInterface
{
    public function __construct(
        private string $apiKey,
        private string $clientId,
        private string $apiEndpoint,
        private ClientInterface $httpClient,
    )
    {
    }

    public function create(): PriceService
    {
        if (!Validator::validateUrl($this->apiEndpoint)) {
            throw new InvalidArgumentException("Provided URL is invalid: " . $this->apiEndpoint);
        }

        $config = new Config(
            $this->apiKey,
            $this->clientId,
            $this->apiEndpoint,
        );

        return new PriceService($config, $this->httpClient);
    }
}
