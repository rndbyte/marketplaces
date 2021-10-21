<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Enums;

final class ProductVisibility
{
    public const ALL = 'ALL'; // All products
    public const VISIBLE = 'VISIBLE'; // Products, visible for customers
    public const INVISIBLE = 'INVISIBLE'; // products, invisible for customers for some reason
    public const EMPTY_STOCK = 'EMPTY_STOCK'; // Products with empty stock
    public const READY_TO_SUPPLY = 'READY_TO_SUPPLY'; // Products with empty stock and state=processed (so you can set stock)
    public const STATE_FAILED = 'STATE_FAILED'; // products which are failed on some step
    public const VISIBILITY_STATUSES = [
        self::ALL,
        self::VISIBLE,
        self::INVISIBLE,
        self::EMPTY_STOCK,
        self::READY_TO_SUPPLY,
        self::STATE_FAILED,
    ];
}
