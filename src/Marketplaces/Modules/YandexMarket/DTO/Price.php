<?php

declare(strict_types=1);

namespace Marketplaces\Modules\YandexMarket\DTO;

class Price
{
    public function __construct(
        public string $currencyId,
        public float $value,
    )
    {
    }
}
