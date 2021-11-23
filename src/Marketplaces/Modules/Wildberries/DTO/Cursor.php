<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Wildberries\DTO;

class Cursor
{
    public function __construct(
        public int $limit,
        public int $offset,
        public int $total,
    )
    {
    }
}
