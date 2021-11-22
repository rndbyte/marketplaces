<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\DTO;

class ProductPrice
{
    public function __construct(
        public string $offer_id,
        public string $price,
        public ?int $product_id = null,
        public ?string $old_price = null,
        public ?string $premium_price = null,
    )
    {
    }
}
