<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Responses\V2;

use stdClass;
use Marketplaces\Components\Abstracts\AbstractMarketplaceResponse;

/**
 * @package Marketplaces\Modules\Ozon\Results\V2
 * @property ProductInfoResponse[] items
 */
final class ProductInfoListResponse extends AbstractMarketplaceResponse
{
    public function __construct(stdClass $payload)
    {
        $data = $payload;
        if (property_exists($data, 'result')) {
            $data = $data->result;
            if (property_exists($data, 'items')) {
                $data->items = array_map(function(stdClass $item) {
                    return ProductInfoResponse::fromObject($item);
                }, $data->items);
            }
        }
        parent::__construct($data);
    }
}
