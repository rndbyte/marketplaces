<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Wildberries\Responses;

use stdClass;
use Marketplaces\Components\Abstracts\AbstractMarketplaceResponse;

/**
 * Class CardListResponse
 * @package Marketplaces\Modules\Wildberries\Responses
 * @property stdClass $result
 */
class GetCardListResponse extends AbstractMarketplaceResponse
{
    public function getCards(): array
    {
        return $this->result->cards;
    }
}
