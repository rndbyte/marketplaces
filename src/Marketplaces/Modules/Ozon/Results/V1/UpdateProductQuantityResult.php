<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Results\V1;

use stdClass;
use Marketplaces\Components\Abstracts\AbstractMarketplaceResponse;

/**
 * Class UpdateProductQuantityResult
 * @package Marketplaces\Modules\Ozon\Results\V1
 * @package Ozon\Services\V1\DTO\Responses
 * @property stdClass[] result
 */
final class UpdateProductQuantityResult extends AbstractMarketplaceResponse
{
    /**
     * Array of updated products.
     *
     * @return stdClass[]
     */
    public function getResult(): array
    {
        return $this->result;
    }

    /**
     * Array of occurred errors.
     * Each item contains code (string), message (string).
     *
     * @param int $index
     * @return stdClass[]
     */
    public function getResultItemErrors(int $index): array
    {
        return $this->result[$index]->errors;
    }

    /**
     * Идентификатор товара.
     *
     * @param int $index
     * @return int
     */
    public function getResultItemProductId(int $index): int
    {
        return $this->result[$index]->product_id;
    }

    /**
     * Идентификатор товара в системе продавца — артикул.
     *
     * @param int $index
     * @return string
     */
    public function getResultItemOfferId(int $index): string
    {
        return $this->result[$index]->offer_id;
    }

    /**
     * True, если информации о товаре успешно обновлена.
     *
     * @param int $index
     * @return bool
     */
    public function getResultItemUpdated(int $index): bool
    {
        return $this->result[$index]->updated;
    }
}
