<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Messages\V1;

use Marketplaces\Contracts\ConfigInterface;
use Marketplaces\Components\Abstracts\AbstractMarketplaceRequest;

class UpdateProductQuantityMessage extends AbstractMarketplaceRequest
{
    public function __construct(
        ConfigInterface $config,
        string $offerId,
        int $stock,
        int $productId = null,
    )
    {
        parent::__construct(
            $config,
            AbstractMarketplaceRequest::POST,
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
