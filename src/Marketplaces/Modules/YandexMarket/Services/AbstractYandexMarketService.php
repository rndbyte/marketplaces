<?php

declare(strict_types=1);

namespace Marketplaces\Modules\YandexMarket\Services;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Marketplaces\Modules\YandexMarket\Enums\ApiErrors;
use Marketplaces\Components\Abstracts\AbstractMarketplaceService;
use Marketplaces\Modules\YandexMarket\Exceptions\YandexMarketException;

abstract class AbstractYandexMarketService extends AbstractMarketplaceService
{
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
     * @throws YandexMarketException
     */
    protected function handleResponseErrors(ResponseInterface $response): void
    {
        $responseBodyContent = $response->getBody()->getContents();
        $errorsData = $this->extractResponseBodyContent($responseBodyContent);
        $exceptionsList = ApiErrors::getExceptionsList();

        if (!array_key_exists('errors', $errorsData) || !array_key_exists($response->getStatusCode(), $exceptionsList)) {
            throw new YandexMarketException('An error has occurred: ' . $responseBodyContent);
        }

        throw new $exceptionsList[$response->getStatusCode()]($errorsData['errors'][0]['message']);
    }

    /**
     * @throws YandexMarketException
     */
    protected function extractResponseBodyContent(string $responseBodyContent): array
    {
        try {
            return json_decode($responseBodyContent, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new YandexMarketException(
                'Invalid json response: ' . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }
}
