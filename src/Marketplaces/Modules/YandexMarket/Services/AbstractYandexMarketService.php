<?php

declare(strict_types=1);

namespace Marketplaces\Modules\YandexMarket\Services;

use stdClass;
use Psr\Http\Message\ResponseInterface;
use Marketplaces\Modules\YandexMarket\Enums\ApiErrors;
use Marketplaces\Components\Exceptions\MarketplaceException;
use Marketplaces\Components\Abstracts\AbstractMarketplaceService;
use Marketplaces\Modules\YandexMarket\Exceptions\NotFoundException;
use Marketplaces\Modules\YandexMarket\Exceptions\InternalException;
use Marketplaces\Modules\YandexMarket\Exceptions\BadRequestException;
use Marketplaces\Modules\YandexMarket\Exceptions\YandexMarketException;
use Marketplaces\Modules\YandexMarket\Exceptions\AccessDeniedException;
use Marketplaces\Modules\YandexMarket\Exceptions\UnauthorizedException;
use Marketplaces\Modules\YandexMarket\Exceptions\EnhanceYourCalmException;
use Marketplaces\Modules\YandexMarket\Exceptions\MethodNotAllowedException;
use Marketplaces\Modules\YandexMarket\Exceptions\UnsupportedMediaTypeException;

abstract class AbstractYandexMarketService extends AbstractMarketplaceService
{
    /**
     * @inheritDoc
     *
     * @throws AccessDeniedException
     * @throws BadRequestException
     * @throws EnhanceYourCalmException
     * @throws InternalException
     * @throws MarketplaceException
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @throws UnauthorizedException
     * @throws UnsupportedMediaTypeException
     * @throws YandexMarketException
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
     * @throws YandexMarketException
     * @throws MarketplaceException
     * @throws NotFoundException
     * @throws InternalException
     * @throws BadRequestException
     * @throws AccessDeniedException
     * @throws UnauthorizedException
     * @throws EnhanceYourCalmException
     * @throws MethodNotAllowedException
     * @throws UnsupportedMediaTypeException
     */
    private function handleResponseErrors(ResponseInterface $response): void
    {
        $responseBodyContent = $response->getBody()->getContents();
        $errorsData = $this->extractResponseJsonContent($responseBodyContent);
        $exceptionsList = ApiErrors::getExceptionsList();

        if (!array_key_exists('errors', (array)$errorsData) || !array_key_exists($response->getStatusCode(), $exceptionsList)) {
            throw new YandexMarketException('An error has occurred: ' . $responseBodyContent);
        }

        throw new $exceptionsList[$response->getStatusCode()]((array)$errorsData['errors'][0]['message']);
    }
}
