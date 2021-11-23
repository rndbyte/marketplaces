<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Wildberries\Requests;

use Marketplaces\Contracts\ConfigInterface;
use Marketplaces\Modules\Wildberries\DTO\Find;
use Marketplaces\Modules\Wildberries\DTO\Cursor;
use Marketplaces\Components\Abstracts\AbstractMarketplaceRequest;

class GetCardListRequest extends AbstractMarketplaceRequest
{
    /**
     * GetCardListRequest constructor.
     * @param ConfigInterface $config
     * @param Find[] $find
     */
    public function __construct(ConfigInterface $config, array $find)
    {
        parent::__construct(
            $config,
            AbstractMarketplaceRequest::POST,
            '/card/list',
            [
                'id' => uniqid(),
                'jsonrpc' => '2.0',
                'params' => [
                    'filter' => [
                        'find' => $find,
                    ],
                    'isArchive' => true,
                    //'query' => $cursor,
                    //'supplierID' => '',
                    'withError' => true,
                ],
            ]
        );
    }
}
