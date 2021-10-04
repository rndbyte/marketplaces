<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Messages\V1;

use Marketplaces\Contracts\Config;
use Marketplaces\Components\Abstracts\MarketplaceRequest;

final class UpdateProductQuantityMessage extends MarketplaceRequest
{
    public function __construct(
        Config $config,
        string $offerId,
        int $stock,
        int $productId = null,
    )
    {
        parent::__construct(
            $config,
            MarketplaceRequest::POST,
            '/v1/product/import/stocks',
            [
                'stocks' => [
                    [
                        'offer_id' => $offerId,
                        'stock' => $stock,
                        'product_id' => $productId,
                    ]
                ]
            ],
        );
    }
}
