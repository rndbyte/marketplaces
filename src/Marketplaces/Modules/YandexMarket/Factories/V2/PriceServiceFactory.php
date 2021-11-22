<?php

declare(strict_types=1);

namespace Marketplaces\Modules\YandexMarket\Factories\V2;

use InvalidArgumentException;
use Psr\Http\Client\ClientInterface;
use Marketplaces\Contracts\FactoryInterface;
use Marketplaces\Modules\YandexMarket\Config;
use Marketplaces\Components\Support\Validator;
use Marketplaces\Modules\YandexMarket\Services\V2\PriceService;

class PriceServiceFactory implements FactoryInterface
{
    public function __construct(
        private string $oauthToken,
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
            $this->oauthToken,
            $this->clientId,
            $this->apiEndpoint,
        );

        return new PriceService($config, $this->httpClient);
    }
}
