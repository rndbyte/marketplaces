<?php

declare(strict_types=1);

namespace Marketplaces\Modules\YandexMarket\Responses\V2;

use Marketplaces\Components\Abstracts\AbstractMarketplaceResponse;

/**
 * Class UpdateProductsPricesResponse
 * @package Marketplaces\Modules\YandexMarket\Responses
 * @property string $status
 * @property array $errors
 */
class UpdateProductsPricesResponse extends AbstractMarketplaceResponse
{
    /**
     * Possible values:
     *
     * OK
     * ERROR
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Array of error objects (error code, error message).
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
