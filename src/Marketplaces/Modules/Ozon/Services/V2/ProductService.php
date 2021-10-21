<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Services\V2;

use Psr\Http\Client\ClientExceptionInterface;
use Marketplaces\Modules\Ozon\Services\AbstractService;
use Marketplaces\Components\Exceptions\MarketplaceException;
use Marketplaces\Modules\Ozon\Results\V2\ProductInfoResult;
use Marketplaces\Modules\Ozon\Factories\ResponseResultFactory;
use Marketplaces\Modules\Ozon\Results\V2\ProductInfoListResult;
use Marketplaces\Modules\Ozon\Messages\V2\GetProductInfoMessage;
use Marketplaces\Modules\Ozon\Messages\V2\GetProductInfoListMessage;

class ProductService extends AbstractService
{
    /**
     * Receive product info.
     *
     * @see https://docs.ozon.ru/api/seller#/v2/product/info
     *
     * @param string $offerId
     * @param int|null $productId
     * @param int|null $sku
     * @return ProductInfoResult
     * @throws ClientExceptionInterface
     * @throws MarketplaceException
     */
    public function info(string $offerId, int $productId = null, int $sku = null): ProductInfoResult
    {
        $request = new GetProductInfoMessage(
            config: $this->config,
            offerId: $offerId,
            productId: $productId,
            sku: $sku,
        );

        /** @var ProductInfoResult $result */
        $result = ResponseResultFactory::new(ProductInfoResult::class, $this->sendRequest($request));
        return $result;
    }

    /**
     * Receive info about list of products.
     *
     * @see https://docs.ozon.ru/api/seller#/v2/product/info/list
     *
     * @param string[] $offerId
     * @param int[] $productId
     * @param int[] $sku
     * @return ProductInfoListResult
     * @throws ClientExceptionInterface
     * @throws MarketplaceException
     */
    public function infoList(array $offerId, array $productId = [], array $sku = []): ProductInfoListResult
    {
        $request = new GetProductInfoListMessage(
            config: $this->config,
            offerId: $offerId,
            productId: $productId,
            sku: $sku,
        );

        /** @var ProductInfoListResult $result */
        $result = ResponseResultFactory::new(ProductInfoListResult::class, $this->sendRequest($request));
        return $result;
    }
}
