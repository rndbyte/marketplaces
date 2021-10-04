<?php

declare(strict_types=1);

namespace Marketplaces\Contracts;

use Stringable;

interface Result extends Stringable, Arrayable
{
    public function getPayload(): mixed;
    public static function fromJson(string $jsonString): static;
}
