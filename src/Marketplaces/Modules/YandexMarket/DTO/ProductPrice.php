<?php

declare(strict_types=1);

namespace Marketplaces\Modules\YandexMarket\DTO;

class ProductPrice
{
    public function __construct(
        public int $marketSku,
        public Price $price,
    )
    {
    }
}
