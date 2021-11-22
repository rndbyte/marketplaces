<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Wildberries\DTO;

class ProductPrice
{
    public function __construct(
        public int $nmId,
        public float $price,
    )
    {
    }
}
