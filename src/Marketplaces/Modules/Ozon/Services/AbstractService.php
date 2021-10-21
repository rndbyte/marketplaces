<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Services;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Marketplaces\Modules\Ozon\Enums\ApiErrors;
use Marketplaces\Components\Abstracts\AbstractMarketplaceService;
use Marketplaces\Modules\Ozon\Factories\ErrorResponseFactory;
use Marketplaces\Modules\Ozon\Exceptions\{NotFoundException,
    InternalException,
    OzonSellerException,
    BadRequestException,
    ValidationException,
    AccessDeniedException,
    RequestTimeoutException,
    NotFoundInSortingCenterException};

abstract class AbstractService extends AbstractMarketplaceService
{
    /**
     * @throws OzonSellerException
     */
    protected function getResponseResultOrThrowException(ResponseInterface $response): string
    {
        $responseBodyContent = $response->getBody()->getContents();

        if (!$this->isValidResponse($response)) {
            $this->throwCorrespondingException($responseBodyContent);
        }

        return $responseBodyContent;
    }

    protected function isValidResponse(ResponseInterface $response): bool
    {
        return $response->getStatusCode() < 400;
    }

    /**
     * @throws OzonSellerException
     * @throws AccessDeniedException
     * @throws BadRequestException
     * @throws NotFoundException
     * @throws InternalException
     * @throws NotFoundInSortingCenterException
     * @throws ValidationException
     * @throws RequestTimeoutException
     */
    protected function throwCorrespondingException(string $responseBodyContent): void
    {
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
                'Invalid json response: ' . $responseBodyContent,
                $e->getCode(),
                $e
            );
        }
    }
}
