<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Messages\V1;

use Marketplaces\Contracts\ConfigInterface;
use Marketplaces\Components\Abstracts\AbstractMarketplaceRequest;
use Marketplaces\Modules\Ozon\DTO\ProductListFilters;

class GetProductListMessage extends AbstractMarketplaceRequest
{
    public function __construct(
        ConfigInterface $config,
        ProductListFilters $filters,
        int $page = null,
        int $pageSize = null,
    )
    {
        parent::__construct(
            $config,
            AbstractMarketplaceRequest::POST,
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
