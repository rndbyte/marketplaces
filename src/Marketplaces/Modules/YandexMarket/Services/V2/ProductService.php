<?php

declare(strict_types=1);

namespace Marketplaces\Modules\YandexMarket\Services\V2;

use Psr\Http\Client\ClientExceptionInterface;
use Marketplaces\Components\Exceptions\MarketplaceException;
use Marketplaces\Modules\YandexMarket\Exceptions\YandexMarketException;
use Marketplaces\Modules\YandexMarket\Services\AbstractYandexMarketService;
use Marketplaces\Modules\YandexMarket\Requests\UpdateProductsPricesRequest;
use Marketplaces\Modules\YandexMarket\Responses\UpdateProductsPricesResponse;

class ProductService extends AbstractYandexMarketService
{
    /**
     * Update the prices for many products.
     *
     * @see https://yandex.ru/dev/market/partner/doc/dg/reference/post-campaigns-id-offer-prices-updates.html
     *
     * @param array $prices
     * @return UpdateProductsPricesResponse
     * @throws ClientExceptionInterface
     * @throws YandexMarketException|MarketplaceException
     */
    public function updatePrices(array $prices): UpdateProductsPricesResponse
    {
        $request = new UpdateProductsPricesRequest($this->config, $prices);

        return new UpdateProductsPricesResponse(json_decode($this->sendRequest($request)));
    }
}
