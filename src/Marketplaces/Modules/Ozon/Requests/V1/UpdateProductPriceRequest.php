<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Requests\V1;

use Marketplaces\Contracts\ConfigInterface;
use Marketplaces\Components\Abstracts\AbstractMarketplaceRequest;

class UpdateProductPriceRequest extends AbstractMarketplaceRequest
{
    public function __construct(
        ConfigInterface $config,
        string $offerId,
        string $price,
        int $productId = null,
        string $oldPrice = null,
        string $premiumPrice = null,
    )
    {
        parent::__construct(
            $config,
            AbstractMarketplaceRequest::POST,
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
