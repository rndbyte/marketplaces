<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Messages\V1;

use Marketplaces\Contracts\Config;
use Marketplaces\Components\Abstracts\MarketplaceRequest;

final class UpdateProductPriceMessage extends MarketplaceRequest
{
    public function __construct(
        Config $config,
        string $offerId,
        string $price,
        int $productId = null,
        string $oldPrice = null,
        string $premiumPrice = null,
    )
    {
        parent::__construct(
            $config,
            MarketplaceRequest::POST,
            '/v1/product/import/prices',
            [
                'prices' => [
                    [
                        'offer_id' => $offerId,
                        'price' => $price,
                        'product_id' => $productId,
                        'old_price' => $oldPrice,
                        'premium_price' => $premiumPrice,
                    ],
                ]
            ],
        );
    }
}
