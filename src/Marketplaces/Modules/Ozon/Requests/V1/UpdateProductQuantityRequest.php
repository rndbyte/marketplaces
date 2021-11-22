<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Requests\V1;

use Marketplaces\Contracts\ConfigInterface;
use Marketplaces\Modules\Ozon\DTO\ProductStock;
use Marketplaces\Components\Abstracts\AbstractMarketplaceRequest;

class UpdateProductQuantityRequest extends AbstractMarketplaceRequest
{
    /**
     * UpdateProductQuantityRequest constructor.
     * @param ConfigInterface $config
     * @param ProductStock[] $stocks
     */
    public function __construct(ConfigInterface $config, array $stocks)
    {
        parent::__construct(
            $config,
            AbstractMarketplaceRequest::POST,
            '/v1/product/import/stocks',
            [
                'stocks' => $stocks
            ],
        );
    }
}
