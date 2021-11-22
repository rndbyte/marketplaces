<?php

declare(strict_types=1);

namespace Marketplaces\Modules\YandexMarket\Responses;

use Marketplaces\Modules\YandexMarket\DTO\Errors;

class PostResponse
{
    const STATUS_ERROR = 'ERROR';
    const STATUS_OK = 'OK';

    /**
     * Errors decoded from response body.
     *
     * @var Errors|null $errors
     */
    protected ?Errors $errors;
    protected string $status;

    /**
     * @return Errors|null
     */
    public function getErrors(): ?Errors
    {
        return $this->errors;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
