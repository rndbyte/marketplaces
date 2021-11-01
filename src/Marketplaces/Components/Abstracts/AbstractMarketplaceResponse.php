<?php

declare(strict_types=1);

namespace Marketplaces\Components\Abstracts;

use stdClass;
use Marketplaces\Contracts\ResponseInterface;

abstract class AbstractMarketplaceResponse implements ResponseInterface
{
    public function __construct(protected stdClass $payload)
    {
    }

    public function getPayload(): stdClass
    {
        return $this->payload;
    }

    public function __toString(): string
    {
        return json_encode($this->payload);
    }

    public function toArray(): array
    {
        return (array) $this->payload;
    }

    public function __isset(string $name): bool
    {
        return isset($this->payload->{$name});
    }

    public function __get(string $name): mixed
    {
        return $this->payload->{$name} ?? null;
    }

    public function __set(string $name, mixed $value): void
    {
        $this->payload->{$name} = $value;
    }
}
