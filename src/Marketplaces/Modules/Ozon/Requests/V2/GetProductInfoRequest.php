<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Requests\V2;

use Marketplaces\Contracts\ConfigInterface;
use Marketplaces\Components\Abstracts\AbstractMarketplaceRequest;

class GetProductInfoRequest extends AbstractMarketplaceRequest
{
    public function __construct(
        ConfigInterface $config,
        string $offerId,
        int $productId = null,
        int $sku = null,
    )
    {
        parent::__construct(
            $config,
            AbstractMarketplaceRequest::POST,
            '/v2/product/info',
            [
                'offer_id' => $offerId,
                'product_id' => $productId,
                'sku' => $sku,
            ]
        );
    }
}
