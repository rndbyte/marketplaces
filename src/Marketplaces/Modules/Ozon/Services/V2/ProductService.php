<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Services\V2;

use Marketplaces\Modules\Ozon\Services\AbstractOzonService;
use Marketplaces\Modules\Ozon\Exceptions\InternalException;
use Marketplaces\Modules\Ozon\Exceptions\NotFoundException;
use Marketplaces\Components\Exceptions\MarketplaceException;
use Marketplaces\Modules\Ozon\Exceptions\OzonSellerException;
use Marketplaces\Modules\Ozon\Exceptions\BadRequestException;
use Marketplaces\Modules\Ozon\Exceptions\ValidationException;
use Marketplaces\Modules\Ozon\Responses\V2\ProductInfoResponse;
use Marketplaces\Modules\Ozon\Exceptions\AccessDeniedException;
use Marketplaces\Modules\Ozon\Requests\V2\GetProductInfoRequest;
use Marketplaces\Modules\Ozon\Exceptions\RequestTimeoutException;
use Marketplaces\Modules\Ozon\Responses\V2\ProductInfoListResponse;
use Marketplaces\Modules\Ozon\Requests\V2\GetProductInfoListRequest;
use Marketplaces\Modules\Ozon\Exceptions\NotFoundInSortingCenterException;

class ProductService extends AbstractOzonService
{
    /**
     * Receive product info.
     *
     * @see https://docs.ozon.ru/api/seller#/v2/product/info
     *
     * @param string $offerId
     * @param int|null $productId
     * @param int|null $sku
     * @return ProductInfoResponse
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
    public function info(
        string $offerId,
        int $productId = null,
        int $sku = null,
    ): ProductInfoResponse
    {
        $request = new GetProductInfoRequest(
            config: $this->config,
            offerId: $offerId,
            productId: $productId,
            sku: $sku,
        );

        $response = $this->sendRequest($request);
        $payload = $this->getResponseContentOrThrowException($response);

        return new ProductInfoResponse($payload);
    }

    /**
     * Receive info about list of products.
     *
     * @see https://docs.ozon.ru/api/seller#/v2/product/info/list
     *
     * @param string[] $offerId
     * @param int[] $productId
     * @param int[] $sku
     * @return ProductInfoListResponse
     *
     * @throws AccessDeniedException
     * @throws BadRequestException
     * @throws InternalException
     * @throws MarketplaceException
     * @throws NotFoundException
     * @throws NotFoundInSortingCenterException
     * @throws OzonSellerException
     * @throws RequestTimeoutException
     * @throws ValidationException
     */
    public function infoList(
        array $offerId,
        array $productId = [],
        array $sku = [],
    ): ProductInfoListResponse
    {
        $request = new GetProductInfoListRequest(
            config: $this->config,
            offerId: $offerId,
            productId: $productId,
            sku: $sku,
        );

        $response = $this->sendRequest($request);
        $payload = $this->getResponseContentOrThrowException($response);

        return new ProductInfoListResponse($payload);
    }
}
