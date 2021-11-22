<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\DTO;

class ProductStock
{
    public function __construct(
        public string $offer_id,
        public int $stock,
        public ?int $product_id = null,
    )
    {
    }
}
