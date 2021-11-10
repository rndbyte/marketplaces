<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Wildberries\Requests;

use Marketplaces\Contracts\ConfigInterface;
use Marketplaces\Components\Abstracts\AbstractMarketplaceRequest;

class UpdateProductsPricesRequest extends AbstractMarketplaceRequest
{
    public function __construct(ConfigInterface $config, array $prices)
    {
        parent::__construct(
            $config,
            AbstractMarketplaceRequest::POST,
            '/public/api/v1/prices',
            $prices,
        );
    }
}
