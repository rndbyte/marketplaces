<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Services\V1;

use Psr\Http\Client\ClientExceptionInterface;
use Marketplaces\Modules\Ozon\DTO\ProductListFilters;
use Marketplaces\Modules\Ozon\Services\AbstractService;
use Marketplaces\Components\Exceptions\MarketplaceException;
use Marketplaces\Modules\Ozon\Results\V1\ProductListResult;
use Marketplaces\Modules\Ozon\Exceptions\OzonSellerException;
use Marketplaces\Modules\Ozon\Messages\V1\GetProductListMessage;
use Marketplaces\Modules\Ozon\Results\V1\UpdateProductPriceResult;
use Marketplaces\Modules\Ozon\Messages\V1\UpdateProductPriceMessage;
use Marketplaces\Modules\Ozon\Results\V1\UpdateProductQuantityResult;
use Marketplaces\Modules\Ozon\Messages\V1\UpdateProductQuantityMessage;

class ProductService extends AbstractService
{
    /**
     * Receive the list of products.
     *
     * @see https://docs.ozon.ru/api/seller#/v1/product/list
     *
     * @param int|null $page
     * @param int|null $pageSize
     * @param string|null $filterByOfferId
     * @param int[]|null $filterByProductId
     * @param string|null $filterByVisibility
     * @return ProductListResult
     * @throws ClientExceptionInterface
     * @throws MarketplaceException
     */
    public function list(
        int $page = null,
        int $pageSize = null,
        string $filterByOfferId = null,
        array $filterByProductId = null,
        string $filterByVisibility = null,
    ): ProductListResult
    {
        $filters = new ProductListFilters(
            offerId: $filterByOfferId,
            productIds: $filterByProductId,
            visibility: $filterByVisibility,
        );

        $request = new GetProductListMessage(
            config: $this->config,
            filters: $filters,
            page: $page,
            pageSize: $pageSize,
        );

        return ProductListResult::fromJson($this->sendRequest($request));
    }

    /**
     * Update the price for one product.
     *
     * @see https://docs.ozon.ru/api/seller#/v1/product/import/prices
     *
     * @param string $offerId
     * @param string $price
     * @param int|null $productId
     * @param string|null $oldPrice
     * @param string|null $premiumPrice
     * @return UpdateProductPriceResult
     * @throws ClientExceptionInterface
     * @throws OzonSellerException|MarketplaceException
     */
    public function updatePrice(
        string $offerId,
        string $price,
        int $productId = null,
        string $oldPrice = null,
        string $premiumPrice = null,
    ): UpdateProductPriceResult
    {
        $request = new UpdateProductPriceMessage(
            config: $this->config,
            offerId: $offerId,
            price: $price,
            productId: $productId,
            oldPrice: $oldPrice,
            premiumPrice: $premiumPrice,
        );

        return UpdateProductPriceResult::fromJson($this->sendRequest($request));
    }

    /**
     * Update the stock for one product.
     *
     * @see https://docs.ozon.ru/api/seller#/v1/product/import/stocks
     *
     * @param string $offerId
     * @param int $stock
     * @param int|null $productId
     * @return UpdateProductQuantityResult
     * @throws ClientExceptionInterface
     * @throws OzonSellerException|MarketplaceException
     */
    public function updateStocks(
        string $offerId,
        int $stock,
        int $productId = null
    ): UpdateProductQuantityResult
    {
        $request = new UpdateProductQuantityMessage(
            config: $this->config,
            offerId: $offerId,
            stock: $stock,
            productId: $productId
        );

        return UpdateProductQuantityResult::fromJson($this->sendRequest($request));
    }
}
