<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\DTO;

use Marketplaces\Modules\Ozon\Enums\ProductVisibility;

class ProductListFilters
{
    public ?string $visibility;

    /**
     * @param int[] $productIds
     */
    public function __construct(
        public ?string $offerId = null,
        public ?array $productIds = null,
        string $visibility = null,
    )
    {
        if (is_string($visibility) && !in_array($visibility, ProductVisibility::VISIBILITY_STATUSES)) {
            throw new \InvalidArgumentException('Invalid visibility value: ' . $visibility);
        }
        $this->visibility = $visibility;
    }
}
