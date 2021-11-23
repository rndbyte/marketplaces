<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Wildberries\Services;

use Marketplaces\Modules\Wildberries\DTO\Find;
use Marketplaces\Components\Exceptions\MarketplaceException;
use Marketplaces\Modules\Wildberries\Requests\GetCardListRequest;
use Marketplaces\Modules\Wildberries\Exceptions\InternalException;
use Marketplaces\Modules\Wildberries\Responses\GetCardListResponse;
use Marketplaces\Modules\Wildberries\Exceptions\BadRequestException;
use Marketplaces\Modules\Wildberries\Exceptions\WildberriesException;
use Marketplaces\Modules\Wildberries\Exceptions\AccessDeniedException;
use Marketplaces\Modules\Wildberries\Exceptions\UnauthorizedException;

class CardService extends AbstractWildberriesService
{
    /**
     * Get list of product cards.
     *
     * @param Find[] $find
     * @return GetCardListResponse
     *
     * @throws MarketplaceException
     * @throws WildberriesException
     * @throws AccessDeniedException
     * @throws BadRequestException
     * @throws InternalException
     * @throws UnauthorizedException
     */
    public function getCardList(array $find): GetCardListResponse
    {
        foreach ($find as $search) {
            if (!$search instanceof Find) {
                throw new WildberriesException(
                    'Provided search filter must be instance of ' . Find::class  . '. ' . get_class($price) . ' given.'
                );
            }
        }

        $request = new GetCardListRequest($this->config, $find);

        $response = $this->sendRequest($request);
        $payload = $this->getResponseContentOrThrowException($response);

        return new GetCardListResponse($payload);
    }
}
