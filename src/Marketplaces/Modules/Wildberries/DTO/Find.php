<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Wildberries\DTO;

use stdClass;

class Find
{
    public function __construct(
        public string $column,
        public stdClass $search,
    )
    {
    }
}
