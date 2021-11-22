<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Wildberries\Services;

use stdClass;
use Psr\Http\Message\ResponseInterface;
use Marketplaces\Modules\Wildberries\Enums\ApiErrors;
use Marketplaces\Components\Exceptions\MarketplaceException;
use Marketplaces\Components\Abstracts\AbstractMarketplaceService;
use Marketplaces\Modules\Wildberries\Exceptions\InternalException;
use Marketplaces\Modules\Wildberries\Exceptions\BadRequestException;
use Marketplaces\Modules\Wildberries\Exceptions\WildberriesException;
use Marketplaces\Modules\Wildberries\Exceptions\UnauthorizedException;
use Marketplaces\Modules\Wildberries\Exceptions\AccessDeniedException;

abstract class AbstractWildberriesService extends AbstractMarketplaceService
{
    /**
     * @inheritDoc
     *
     * @throws AccessDeniedException
     * @throws BadRequestException
     * @throws InternalException
     * @throws MarketplaceException
     * @throws UnauthorizedException
     * @throws WildberriesException
     */
    protected function getResponseContentOrThrowException(ResponseInterface $response): stdClass
    {
        if (!$this->isValidResponse($response)) {
            $this->handleResponseErrors($response);
        }

        return $this->extractResponseJsonContent($response->getBody()->getContents());
    }

    /**
     * @param ResponseInterface $response
     *
     * @throws WildberriesException
     * @throws MarketplaceException
     * @throws InternalException
     * @throws BadRequestException
     * @throws UnauthorizedException
     * @throws AccessDeniedException
     */
    private function handleResponseErrors(ResponseInterface $response): void
    {
        $responseBodyContent = $response->getBody()->getContents();
        $errorData = $this->extractResponseJsonContent($responseBodyContent);
        $exceptionsList = ApiErrors::getExceptionsList();

        if (!array_key_exists($response->getStatusCode(), $exceptionsList)) {
            throw new WildberriesException('An error has occurred: ' . $responseBodyContent);
        }

        throw new $exceptionsList[$response->getStatusCode()]();
    }
}
