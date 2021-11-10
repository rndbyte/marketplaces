<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Wildberries\Services;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Marketplaces\Modules\Wildberries\Enums\ApiErrors;
use Marketplaces\Components\Abstracts\AbstractMarketplaceService;
use Marketplaces\Modules\Wildberries\Exceptions\WildberriesException;

abstract class AbstractWildberriesService extends AbstractMarketplaceService
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
     * @throws WildberriesException
     */
    protected function handleResponseErrors(ResponseInterface $response): void
    {
        $responseBodyContent = $response->getBody()->getContents();
        $errorData = $this->extractResponseBodyContent($responseBodyContent);
        $exceptionsList = ApiErrors::getExceptionsList();

        if (!array_key_exists($response->getStatusCode(), $exceptionsList)) {
            throw new WildberriesException('An error has occurred: ' . $responseBodyContent);
        }

        throw new $exceptionsList[$response->getStatusCode()]();
    }

    /**
     * @param string $responseBodyContent
     * @return array
     * @throws WildberriesException
     */
    protected function extractResponseBodyContent(string $responseBodyContent): array
    {
        try {
            return json_decode($responseBodyContent, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new WildberriesException(
                'Invalid json response: ' . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }
}
