<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Services\V1;

use Marketplaces\Modules\Ozon\DTO\ProductStock;
use Marketplaces\Modules\Ozon\Services\AbstractOzonService;
use Marketplaces\Modules\Ozon\Exceptions\InternalException;
use Marketplaces\Modules\Ozon\Exceptions\NotFoundException;
use Marketplaces\Components\Exceptions\MarketplaceException;
use Marketplaces\Modules\Ozon\Exceptions\OzonSellerException;
use Marketplaces\Modules\Ozon\Exceptions\BadRequestException;
use Marketplaces\Modules\Ozon\Exceptions\ValidationException;
use Marketplaces\Modules\Ozon\Exceptions\AccessDeniedException;
use Marketplaces\Modules\Ozon\Exceptions\RequestTimeoutException;
use Marketplaces\Modules\Ozon\Requests\V1\UpdateProductQuantityRequest;
use Marketplaces\Modules\Ozon\Responses\V1\UpdateProductQuantityResponse;
use Marketplaces\Modules\Ozon\Exceptions\NotFoundInSortingCenterException;

class StockService extends AbstractOzonService
{
    /**
     * Update the stock for one product.
     *
     * @see https://docs.ozon.ru/api/seller#/v1/product/import/stocks
     *
     * @param ProductStock[] $stocks
     * @return UpdateProductQuantityResponse
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
    public function updateStocks(array $stocks): UpdateProductQuantityResponse
    {
        foreach ($stocks as $stock) {
            if (!$stocks instanceof ProductStock) {
                throw new OzonSellerException(
                    'Provided stock must be instance of ' . ProductStock::class  . '. ' . get_class($stock) . ' given.'
                );
            }
        }

        $request = new UpdateProductQuantityRequest($this->config, $stocks);

        $response = $this->sendRequest($request);
        $payload = $this->getResponseContentOrThrowException($response);

        return new UpdateProductQuantityResponse($payload);
    }
}
