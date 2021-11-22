<?php

declare(strict_types=1);

namespace Marketplaces\Modules\YandexMarket\Services\V2;

use Marketplaces\Modules\YandexMarket\DTO\ProductPrice;
use Marketplaces\Components\Exceptions\MarketplaceException;
use Marketplaces\Modules\YandexMarket\Exceptions\InternalException;
use Marketplaces\Modules\YandexMarket\Exceptions\NotFoundException;
use Marketplaces\Modules\YandexMarket\Exceptions\BadRequestException;
use Marketplaces\Modules\YandexMarket\Exceptions\YandexMarketException;
use Marketplaces\Modules\YandexMarket\Exceptions\AccessDeniedException;
use Marketplaces\Modules\YandexMarket\Exceptions\UnauthorizedException;
use Marketplaces\Modules\YandexMarket\Exceptions\EnhanceYourCalmException;
use Marketplaces\Modules\YandexMarket\Services\AbstractYandexMarketService;
use Marketplaces\Modules\YandexMarket\Exceptions\MethodNotAllowedException;
use Marketplaces\Modules\YandexMarket\Requests\V2\UpdateProductsPricesRequest;
use Marketplaces\Modules\YandexMarket\Exceptions\UnsupportedMediaTypeException;
use Marketplaces\Modules\YandexMarket\Responses\V2\UpdateProductsPricesResponse;

class PriceService extends AbstractYandexMarketService
{
    /**
     * Update the prices for many products.
     *
     * @see https://yandex.ru/dev/market/partner/doc/dg/reference/post-campaigns-id-offer-prices-updates.html
     *
     * @param string $campaignId
     * @param ProductPrice[] $prices
     * @param null $dbgKey
     * @return UpdateProductsPricesResponse
     *
     * @throws MarketplaceException
     * @throws YandexMarketException
     * @throws AccessDeniedException
     * @throws BadRequestException
     * @throws EnhanceYourCalmException
     * @throws InternalException
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @throws UnauthorizedException
     * @throws UnsupportedMediaTypeException
     */
    public function updatePrices(string $campaignId, array $prices, $dbgKey = null): UpdateProductsPricesResponse
    {
        foreach ($prices as $price) {
            if (!$price instanceof ProductPrice) {
                throw new YandexMarketException(
                    'Provided price must be instance of ' . ProductPrice::class  . '. ' . get_class($price) . ' given.'
                );
            }
        }

        $request = new UpdateProductsPricesRequest($this->config, $campaignId, $prices);

        $response = $this->sendRequest($request);
        $payload = $this->getResponseContentOrThrowException($response);

        return new UpdateProductsPricesResponse($payload);
    }

    /**
     * @see https://tech.yandex.ru/market/partner/doc/dg/reference/post-campaigns-id-offer-prices-removals-docpage/
     */
//    public function deletePrices(int $campaignId, $dbgKey = null)
//    {
//    }

    /**
     * @see https://tech.yandex.ru/market/partner/doc/dg/reference/get-campaigns-id-offer-prices-docpage/
     */
//    public function getOfferPrices(int $campaignId, array $params = [], $dbgKey = null)
//    {
//    }
}
