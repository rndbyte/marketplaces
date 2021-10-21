<?php

declare(strict_types=1);

namespace Marketplaces\Contracts;

use Stringable;

interface ResultInterface extends Stringable, ArrayableInterface
{
    public function getPayload(): mixed;
}
