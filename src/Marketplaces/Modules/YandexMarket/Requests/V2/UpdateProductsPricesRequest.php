<?php

declare(strict_types=1);

namespace Marketplaces\Modules\YandexMarket\Requests\V2;

use Marketplaces\Contracts\ConfigInterface;
use Marketplaces\Modules\YandexMarket\DTO\ProductPrice;
use Marketplaces\Components\Abstracts\AbstractMarketplaceRequest;

class UpdateProductsPricesRequest extends AbstractMarketplaceRequest
{
    /**
     * UpdateProductsPricesRequest constructor.
     * @param ConfigInterface $config
     * @param string $campaignId
     * @param ProductPrice[] $offers
     */
    public function __construct(ConfigInterface $config, string $campaignId, array $offers)
    {
        parent::__construct(
            $config,
            AbstractMarketplaceRequest::POST,
            '/v2/campaigns/'. $campaignId . '/offer-prices/updates',
            [
                'offers' => $offers,
            ]
        );
    }
}
