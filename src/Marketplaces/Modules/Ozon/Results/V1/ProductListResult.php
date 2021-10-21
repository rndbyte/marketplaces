<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Results\V1;

use stdClass;
use Marketplaces\Components\Abstracts\AbstractHttpResponseResult;

/**
 * Class ProductListResult
 * @package Marketplaces\Modules\Ozon\Results\V1
 * @package Ozon\Services\V1\DTO\Responses\Product
 * @property stdClass result
 */
final class ProductListResult extends AbstractHttpResponseResult
{
    public function getResult(): stdClass
    {
        return $this->result;
    }

    /**
     * Array of products.
     * Each product contains offer_id and product_id.
     *
     * @return stdClass[]
     */
    public function getResultItems(): array
    {
        return $this->result->items;
    }

    /**
     * Total number of products.
     *
     * @return int
     */
    public function getResultTotal(): int
    {
        return $this->result->total;
    }
}
