<?php

declare(strict_types=1);

namespace Marketplaces\Modules\YandexMarket\DTO;

class Error
{
    public function __construct(
        public string $code,
        public string $message,
    )
    {
    }
}
