<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Messages\V2;

use Marketplaces\Contracts\ConfigInterface;
use Marketplaces\Components\Abstracts\AbstractMarketplaceRequest;

/**
 * Информация о списке товаров.
 * В теле запроса должен быть массив однотипных идентификаторов, в ответе будет массив items.
 * Внутри items для каждого отправления поля совпадают с POST v2/product/info/
 *
 * Class GetProductInfoListMessage
 * @package Marketplaces\Modules\Ozon\Messages\V2
 */
class GetProductInfoListMessage extends AbstractMarketplaceRequest
{
    /**
     * @param string[] $offerId
     * @param int[] $productId
     * @param int[] $sku
     */
    public function __construct(
        ConfigInterface $config,
        array $offerId,
        array $productId = [],
        array $sku = [],
    )
    {
        parent::__construct(
            $config,
            AbstractMarketplaceRequest::POST,
            '/v2/product/info/list',
            [
                'offer_id' => $offerId,
                'product_id' => $productId,
                'sku' => $sku,
            ],
        );
    }
}
