<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Services\V1;

use Marketplaces\Modules\Ozon\DTO\ProductPrice;
use Marketplaces\Modules\Ozon\Services\AbstractOzonService;
use Marketplaces\Modules\Ozon\Exceptions\InternalException;
use Marketplaces\Modules\Ozon\Exceptions\NotFoundException;
use Marketplaces\Components\Exceptions\MarketplaceException;
use Marketplaces\Modules\Ozon\Exceptions\OzonSellerException;
use Marketplaces\Modules\Ozon\Exceptions\BadRequestException;
use Marketplaces\Modules\Ozon\Exceptions\ValidationException;
use Marketplaces\Modules\Ozon\Exceptions\AccessDeniedException;
use Marketplaces\Modules\Ozon\Exceptions\RequestTimeoutException;
use Marketplaces\Modules\Ozon\Requests\V1\UpdateProductsPricesRequest;
use Marketplaces\Modules\Ozon\Responses\V1\UpdateProductPriceResponse;
use Marketplaces\Modules\Ozon\Exceptions\NotFoundInSortingCenterException;

class PriceService extends AbstractOzonService
{
    /**
     * Update prices for many products.
     *
     * @see https://docs.ozon.ru/api/seller#/v1/product/import/prices
     *
     * @param ProductPrice[] $prices
     * @return UpdateProductPriceResponse
     *
     * @throws MarketplaceException
     * @throws OzonSellerException
     * @throws AccessDeniedException
     * @throws BadRequestException
     * @throws InternalException
     * @throws NotFoundException
     * @throws NotFoundInSortingCenterException
     * @throws RequestTimeoutException
     * @throws ValidationException
     */
    public function updatePrices(array $prices): UpdateProductPriceResponse
    {
        foreach ($prices as $price) {
            if (!$price instanceof ProductPrice) {
                throw new OzonSellerException(
                    'Provided price must be instance of ' . ProductPrice::class  . '. ' . get_class($price) . ' given.'
                );
            }
        }

        $request = new UpdateProductsPricesRequest($this->config, $prices);

        $response = $this->sendRequest($request);
        $payload = $this->getResponseContentOrThrowException($response);

        return new UpdateProductPriceResponse($payload);
    }
}
