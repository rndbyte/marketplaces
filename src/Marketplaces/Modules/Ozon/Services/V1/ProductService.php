<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Services\V1;

use Psr\Http\Client\ClientExceptionInterface;
use Marketplaces\Modules\Ozon\DTO\ProductListFilters;
use Marketplaces\Modules\Ozon\Services\AbstractOzonService;
use Marketplaces\Modules\Ozon\Results\V1\ProductListResult;
use Marketplaces\Components\Factories\ResponseResultFactory;
use Marketplaces\Components\Exceptions\MarketplaceException;
use Marketplaces\Modules\Ozon\Exceptions\OzonSellerException;
use Marketplaces\Modules\Ozon\Messages\V1\GetProductListMessage;
use Marketplaces\Modules\Ozon\Results\V1\UpdateProductPriceResult;
use Marketplaces\Modules\Ozon\Messages\V1\UpdateProductPriceMessage;
use Marketplaces\Modules\Ozon\Results\V1\UpdateProductQuantityResult;
use Marketplaces\Modules\Ozon\Messages\V1\UpdateProductsPricesMessage;
use Marketplaces\Modules\Ozon\Messages\V1\UpdateProductQuantityMessage;

class ProductService extends AbstractOzonService
{
    /**
     * Receive the list of products.
     *
     * @see https://docs.ozon.ru/api/seller#/v1/product/list
     *
     * @param int|null $page
     * @param int|null $pageSize
     * @param ProductListFilters|null $filters
     * @return ProductListResult
     * @throws ClientExceptionInterface
     * @throws MarketplaceException
     */
    public function list(
        int $page = null,
        int $pageSize = null,
        ProductListFilters $filters = null,
    ): ProductListResult
    {
        $request = new GetProductListMessage(
            config: $this->config,
            filters: $filters ?? new ProductListFilters(),
            page: $page,
            pageSize: $pageSize,
        );

        /** @var ProductListResult $result */
        $result = ResponseResultFactory::new(ProductListResult::class, $this->sendRequest($request));
        return $result;
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

        /** @var UpdateProductPriceResult $result */
        $result = ResponseResultFactory::new(UpdateProductPriceResult::class, $this->sendRequest($request));
        return $result;
    }

    /**
     * Update the prices for many products.
     *
     * @see https://docs.ozon.ru/api/seller#/v1/product/import/prices
     *
     * @param array[] $prices
     * @return UpdateProductPriceResult
     * @throws ClientExceptionInterface
     * @throws MarketplaceException
     */
    public function updatePrices(array $prices): UpdateProductPriceResult
    {
        $request = new UpdateProductsPricesMessage($this->config, $prices);

        /** @var UpdateProductPriceResult $result */
        $result = ResponseResultFactory::new(UpdateProductPriceResult::class, $this->sendRequest($request));
        return $result;
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

        /** @var UpdateProductQuantityResult $result */
        $result = ResponseResultFactory::new(UpdateProductQuantityResult::class, $this->sendRequest($request));
        return $result;
    }
}
