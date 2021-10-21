<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Results\V2;

use stdClass;
use Marketplaces\Components\Abstracts\AbstractHttpResponseResult;

/**
 * @package Marketplaces\Modules\Ozon\Results\V2
 * @property ProductInfoResult[] items
 */
final class ProductInfoListResult extends AbstractHttpResponseResult
{
    protected function __construct(stdClass $payload)
    {
        $data = $payload;
        if (property_exists($data, 'result')) {
            $data = $data->result;
            if (property_exists($data, 'items')) {
                $data->items = array_map(function(stdClass $item) {
                    return ProductInfoResult::fromObject($item);
                }, $data->items);
            }
        }
        parent::__construct($data);
    }
}
