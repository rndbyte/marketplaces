<?php

declare(strict_types=1);

namespace Marketplaces\Contracts;

use Stringable;

interface MarketplaceResponseInterface extends Stringable, ArrayableInterface
{
    public function getPayload(): mixed;
}
