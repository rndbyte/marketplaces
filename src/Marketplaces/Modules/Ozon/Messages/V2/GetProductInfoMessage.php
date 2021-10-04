<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Messages\V2;

use Marketplaces\Contracts\Config;
use Marketplaces\Components\Abstracts\MarketplaceRequest;

final class GetProductInfoMessage extends MarketplaceRequest
{
    public function __construct(
        Config $config,
        string $offerId,
        int $productId = null,
        int $sku = null,
    )
    {
        parent::__construct(
            $config,
            MarketplaceRequest::POST,
            '/v2/product/info',
            [
                'offer_id' => $offerId,
                'product_id' => $productId,
                'sku' => $sku,
            ]
        );
    }
}
