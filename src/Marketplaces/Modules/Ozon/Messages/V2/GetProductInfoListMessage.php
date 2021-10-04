<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Messages\V2;

use Marketplaces\Contracts\Config;
use Marketplaces\Components\Abstracts\MarketplaceRequest;

/**
 * Информация о списке товаров.
 * В теле запроса должен быть массив однотипных идентификаторов, в ответе будет массив items.
 * Внутри items для каждого отправления поля совпадают с POST v2/product/info/
 *
 * Class GetProductInfoListMessage
 * @package Marketplaces\Modules\Ozon\Messages\V2
 */
final class GetProductInfoListMessage extends MarketplaceRequest
{
    /**
     * @param string[] $offerId
     * @param int[] $productId
     * @param int[] $sku
     */
    public function __construct(
        Config $config,
        array $offerId,
        array $productId = [],
        array $sku = [],
    )
    {
        parent::__construct(
            $config,
            MarketplaceRequest::POST,
            '/v2/product/info/list',
            [
                'offer_id' => $offerId,
                'product_id' => $productId,
                'sku' => $sku,
            ],
        );
    }
}
