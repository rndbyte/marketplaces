<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Services;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Marketplaces\Modules\Ozon\Enums\ApiErrors;
use Marketplaces\Modules\Ozon\Factories\ErrorResponseFactory;
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
     * @throws OzonSellerException
     */
    protected function getResponseResultOrThrowException(ResponseInterface $response): string
    {
        if (!$this->isValidResponse($response)) {
            $this->handleResponseErrors($response);
        }

        return $response->getBody()->getContents();
    }

    protected function isValidResponse(ResponseInterface $response): bool
    {
        return $response->getStatusCode() < 400;
    }

    /**
     * @param ResponseInterface $response
     * @throws OzonSellerException
     * @throws AccessDeniedException
     * @throws BadRequestException
     * @throws NotFoundException
     * @throws InternalException
     * @throws NotFoundInSortingCenterException
     * @throws ValidationException
     * @throws RequestTimeoutException
     */
    protected function handleResponseErrors(ResponseInterface $response): void
    {
        $responseBodyContent = $response->getBody()->getContents();
        $errorData = $this->extractResponseBodyContentData($responseBodyContent);
        $errorResponseDto = ErrorResponseFactory::new()->create($errorData);
        $exceptionsList = ApiErrors::getExceptionsList();

        if (!array_key_exists($errorResponseDto->code, $exceptionsList)) {
            throw new OzonSellerException('An error has occurred: ' . $responseBodyContent);
        }

        throw new $exceptionsList[$errorResponseDto->code]($errorResponseDto->message);
    }

    /**
     * @throws OzonSellerException
     */
    private function extractResponseBodyContentData(string $responseBodyContent): array
    {
        try {
            return json_decode($responseBodyContent, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new OzonSellerException(
                'Invalid json response: ' . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }
}
