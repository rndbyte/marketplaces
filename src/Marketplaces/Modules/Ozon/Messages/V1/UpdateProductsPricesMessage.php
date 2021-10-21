<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Messages\V1;

use Marketplaces\Contracts\ConfigInterface;
use Marketplaces\Components\Abstracts\AbstractMarketplaceRequest;

class UpdateProductsPricesMessage extends AbstractMarketplaceRequest
{
    public function __construct(ConfigInterface $config, array $prices)
    {
        parent::__construct(
            $config,
            AbstractMarketplaceRequest::POST,
            '/v1/product/import/prices',
            [
                'prices' => $prices
            ]
        );
    }
}
