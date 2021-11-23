<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Wildberries\Requests\V2;

use Marketplaces\Contracts\ConfigInterface;
use Marketplaces\Components\Abstracts\AbstractMarketplaceRequest;

class GetStocksRequest extends AbstractMarketplaceRequest
{
    public function __construct(
        ConfigInterface $config,
        string $search = 'Ut',
        string $skip = 'Ut',
        string $take = 'Ut',
        string $order = 'desc',
    )
    {
        parent::__construct(
            $config,
            AbstractMarketplaceRequest::GET,
            '/api/v2/stocks?search='. $search .'&skip='. $skip .'&take='. $take .'&order=' . $order,
        );
    }
}
