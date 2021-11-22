<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Services;

use stdClass;
use Psr\Http\Message\ResponseInterface;
use Marketplaces\Modules\Ozon\Enums\ApiErrors;
use Marketplaces\Modules\Ozon\Factories\ErrorFactory;
use Marketplaces\Components\Exceptions\MarketplaceException;
use Marketplaces\Components\Abstracts\AbstractMarketplaceService;
use Marketplaces\Modules\Ozon\Exceptions\{NotFoundException,
    InternalException,
    OzonSellerException,
    BadRequestException,
    ValidationException,
    AccessDeniedException,
    RequestTimeoutException,
    NotFoundInSortingCenterException};

abstract class AbstractOzonService extends AbstractMarketplaceService
{
    /**
     * @inheritDoc
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
    protected function getResponseContentOrThrowException(ResponseInterface $response): stdClass
    {
        if (!$this->isValidResponse($response)) {
            $this->handleResponseErrors($response);
        }

        return $this->extractResponseJsonContent($response->getBody()->getContents());
    }

    /**
     * Handle specific api errors.
     *
     * @param ResponseInterface $response
     *
     * @throws MarketplaceException
     * @throws OzonSellerException
     * @throws AccessDeniedException
     * @throws BadRequestException
     * @throws NotFoundException
     * @throws InternalException
     * @throws NotFoundInSortingCenterException
     * @throws ValidationException
     * @throws RequestTimeoutException
     */
    private function handleResponseErrors(ResponseInterface $response): void
    {
        $responseBodyContent = $response->getBody()->getContents();
        $errorData = $this->extractResponseJsonContent($responseBodyContent);
        $errorDto = ErrorFactory::new()->create((array)$errorData);
        $exceptionsList = ApiErrors::getExceptionsList();

        if (!array_key_exists($errorDto->code, $exceptionsList)) {
            throw new OzonSellerException('An error has occurred: ' . $responseBodyContent);
        }

        throw new $exceptionsList[$errorDto->code]($errorDto->message);
    }
}
