<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Wildberries\DTO;

class Error
{
    public function __construct(
        public bool $error,
        public string $errorText,
    )
    {
    }
}
