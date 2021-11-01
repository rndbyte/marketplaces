<?php

declare(strict_types=1);

namespace Marketplaces\Modules\YandexMarket\Services;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Marketplaces\Modules\YandexMarket\Enums\ApiErrors;
use Marketplaces\Components\Abstracts\AbstractMarketplaceService;
use Marketplaces\Modules\YandexMarket\Exceptions\YandexMarketException;

class AbstractYandexMarketService extends AbstractMarketplaceService
{
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
     * @param string $responseBodyContent
     * @throws YandexMarketException
     */
    protected function throwCorrespondingException(string $responseBodyContent): void
    {
        $errorsData = $this->extractResponseBodyContent($responseBodyContent);
        $exceptionsList = ApiErrors::getExceptionsList();

        if (!array_key_exists($errorsData['errors'][0]['code'], $exceptionsList)) {
            throw new YandexMarketException('An error has occurred: ' . $responseBodyContent);
        }

        throw new $exceptionsList[$errorsData['errors'][0]['code']]($errorsData[0]['message']);
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
                'Invalid json response: ' . $responseBodyContent,
                $e->getCode(),
                $e,
            );
        }
    }
}
