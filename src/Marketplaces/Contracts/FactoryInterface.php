<?php

declare(strict_types=1);

namespace Marketplaces\Contracts;

interface FactoryInterface
{
    public function create(): mixed;
}
