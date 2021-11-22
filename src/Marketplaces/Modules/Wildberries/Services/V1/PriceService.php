<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Wildberries\Services\V1;

use Marketplaces\Modules\Wildberries\DTO\ProductPrice;
use Marketplaces\Components\Exceptions\MarketplaceException;
use Marketplaces\Modules\Wildberries\Exceptions\InternalException;
use Marketplaces\Modules\Wildberries\Exceptions\BadRequestException;
use Marketplaces\Modules\Wildberries\Exceptions\WildberriesException;
use Marketplaces\Modules\Wildberries\Exceptions\AccessDeniedException;
use Marketplaces\Modules\Wildberries\Exceptions\UnauthorizedException;
use Marketplaces\Modules\Wildberries\Services\AbstractWildberriesService;
use Marketplaces\Modules\Wildberries\Requests\V1\UpdateProductsPricesRequest;
use Marketplaces\Modules\Wildberries\Responses\V1\UpdateProductsPricesResponse;

class PriceService extends AbstractWildberriesService
{
    /**
     * Update the prices for many products.
     *
     * @see https://suppliers-api.wildberries.ru/swagger/index.html#/%D0%A6%D0%B5%D0%BD%D1%8B/post_public_api_v1_prices
     *
     * @param ProductPrice[] $prices
     * @return UpdateProductsPricesResponse
     *
     * @throws MarketplaceException
     * @throws WildberriesException
     * @throws AccessDeniedException
     * @throws BadRequestException
     * @throws InternalException
     * @throws UnauthorizedException
     */
    public function updatePrices(array $prices): UpdateProductsPricesResponse
    {
        foreach ($prices as $price) {
            if (!$price instanceof ProductPrice) {
                throw new WildberriesException(
                    'Provided price must be instance of ' . ProductPrice::class  . '. ' . get_class($price) . ' given.'
                );
            }
        }

        $request = new UpdateProductsPricesRequest($this->config, $prices);

        $response = $this->sendRequest($request);
        $payload = $this->getResponseContentOrThrowException($response);

        return new UpdateProductsPricesResponse($payload);
    }
}
