<?php

declare(strict_types=1);

namespace Marketplaces\Contracts;

interface Factory
{
    public static function new(): self;
    public function create(): mixed;
}
