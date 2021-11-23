<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Wildberries\Responses\V2;

use stdClass;
use Marketplaces\Components\Abstracts\AbstractMarketplaceResponse;

/**
 * Class GetStocksResponse
 * @package Marketplaces\Modules\Wildberries\Responses\V2
 * @property int $total
 * @property stdClass[] $stocks
 */
class GetStocksResponse extends AbstractMarketplaceResponse
{
    public function getStockBarcode(int $index): string
    {
        return $this->stocks[$index]->barcode;
    }

    public function getStockArticle(int $index): string
    {
        return $this->stocks[$index]->article;
    }

    public function getStockName(int $index): string
    {
        return $this->stocks[$index]->name;
    }

    public function getStockQuantity(int $index): int
    {
        return $this->stocks[$index]->stock;
    }
}
