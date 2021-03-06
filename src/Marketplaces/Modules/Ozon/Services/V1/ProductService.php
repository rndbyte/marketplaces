<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Services\V1;

use Marketplaces\Modules\Ozon\DTO\ProductListFilters;
use Marketplaces\Modules\Ozon\Services\AbstractOzonService;
use Marketplaces\Modules\Ozon\Exceptions\InternalException;
use Marketplaces\Modules\Ozon\Exceptions\NotFoundException;
use Marketplaces\Components\Exceptions\MarketplaceException;
use Marketplaces\Modules\Ozon\Exceptions\OzonSellerException;
use Marketplaces\Modules\Ozon\Exceptions\BadRequestException;
use Marketplaces\Modules\Ozon\Exceptions\ValidationException;
use Marketplaces\Modules\Ozon\Responses\V1\ProductListResponse;
use Marketplaces\Modules\Ozon\Exceptions\AccessDeniedException;
use Marketplaces\Modules\Ozon\Requests\V1\GetProductListRequest;
use Marketplaces\Modules\Ozon\Exceptions\RequestTimeoutException;
use Marketplaces\Modules\Ozon\Exceptions\NotFoundInSortingCenterException;

class ProductService extends AbstractOzonService
{
    /**
     * Receive the list of products.
     *
     * @see https://docs.ozon.ru/api/seller#/v1/product/list
     *
     * @param int $page
     * @param int $pageSize
     * @param ProductListFilters|null $filters
     * @return ProductListResponse
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
    public function list(
        int $page,
        int $pageSize,
        ProductListFilters $filters = null,
    ): ProductListResponse
    {
        $request = new GetProductListRequest(
            config: $this->config,
            filters: $filters ?? new ProductListFilters(),
            page: $page,
            pageSize: $pageSize,
        );

        $response = $this->sendRequest($request);
        $payload = $this->getResponseContentOrThrowException($response);

        return new ProductListResponse($payload);
    }
}
