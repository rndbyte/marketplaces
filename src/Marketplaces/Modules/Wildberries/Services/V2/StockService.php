<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Wildberries\Services\V2;

use Marketplaces\Components\Exceptions\MarketplaceException;
use Marketplaces\Modules\Wildberries\Requests\V2\GetStocksRequest;
use Marketplaces\Modules\Wildberries\Exceptions\InternalException;
use Marketplaces\Modules\Wildberries\Responses\V2\GetStocksResponse;
use Marketplaces\Modules\Wildberries\Exceptions\BadRequestException;
use Marketplaces\Modules\Wildberries\Exceptions\WildberriesException;
use Marketplaces\Modules\Wildberries\Exceptions\AccessDeniedException;
use Marketplaces\Modules\Wildberries\Exceptions\UnauthorizedException;
use Marketplaces\Modules\Wildberries\Services\AbstractWildberriesService;

class StockService extends AbstractWildberriesService
{
    /**
     * @param string $search
     * @param string $skip
     * @param string $take
     * @param string $order
     * @return GetStocksResponse
     *
     * @throws MarketplaceException
     * @throws AccessDeniedException
     * @throws BadRequestException
     * @throws InternalException
     * @throws UnauthorizedException
     * @throws WildberriesException
     */
    public function getStocks(
        string $search = 'Ut',
        string $skip = 'Ut',
        string $take = 'Ut',
        string $order = 'desc',
    )
    {
        $request = new GetStocksRequest($this->config, $search, $skip, $take, $order);

        $response = $this->sendRequest($request);
        $payload = $this->getResponseContentOrThrowException($response);

        return new GetStocksResponse($payload);
    }

//    public function updateStocks()
//    {
        //
//    }
}
