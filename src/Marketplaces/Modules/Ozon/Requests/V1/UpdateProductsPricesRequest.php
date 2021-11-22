<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Requests\V1;

use Marketplaces\Contracts\ConfigInterface;
use Marketplaces\Modules\Ozon\DTO\ProductPrice;
use Marketplaces\Components\Abstracts\AbstractMarketplaceRequest;

class UpdateProductsPricesRequest extends AbstractMarketplaceRequest
{
    /**
     * UpdateProductsPricesRequest constructor.
     * @param ConfigInterface $config
     * @param ProductPrice[] $prices
     */
    public function __construct(ConfigInterface $config, array $prices)
    {
        parent::__construct(
            $config,
            AbstractMarketplaceRequest::POST,
            '/v1/product/import/prices',
            [
                'prices' => $prices,
            ]
        );
    }
}
