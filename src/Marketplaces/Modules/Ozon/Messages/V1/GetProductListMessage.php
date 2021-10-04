<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Messages\V1;

use Marketplaces\Contracts\Config;
use Marketplaces\Components\Abstracts\MarketplaceRequest;
use Marketplaces\Modules\Ozon\DTO\ProductListFilters;

final class GetProductListMessage extends MarketplaceRequest
{
    public function __construct(
        Config $config,
        ProductListFilters $filters,
        int $page = null,
        int $pageSize = null,
    )
    {
        parent::__construct(
            $config,
            MarketplaceRequest::POST,
            '/v1/product/list',
            [
                'page' => $page,
                'page_size' => $pageSize,
                'filter' => [
                    'offer_id' => $filters->offerId,
                    'product_id' => $filters->productIds,
                    'visibility' => $filters->visibility,
                ],
            ],
        );
    }
}
