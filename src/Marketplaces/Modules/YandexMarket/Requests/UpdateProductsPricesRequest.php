<?php

declare(strict_types=1);

namespace Marketplaces\Modules\YandexMarket\Requests;

use Marketplaces\Contracts\ConfigInterface;
use Marketplaces\Components\Abstracts\AbstractMarketplaceRequest;

class UpdateProductsPricesRequest extends AbstractMarketplaceRequest
{
    public function __construct(ConfigInterface $config, array $offers)
    {
        parent::__construct(
            $config,
            AbstractMarketplaceRequest::POST,
            '/v2/campaigns/'. $config->getSecretToken() . '/offer-prices/updates',
            [
                'offers' => $offers,
            ]
        );
    }
}
