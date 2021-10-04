<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\DTO;

final class ErrorResponse
{
    public function __construct(
        public string $code,
        public string $message,
        public array $data,
    )
    {
    }
}
