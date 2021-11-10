<?php

declare(strict_types=1);

namespace Marketplaces\Components\Abstracts;

use stdClass;
use Marketplaces\Contracts\MarketplaceResponseInterface;

/**
 * Class AbstractMarketplaceResponse
 *
 * Responsibility of this class is to hold and calculate data of http response (with possible errors).
 *
 * @package Marketplaces\Components\Abstracts
 */
abstract class AbstractMarketplaceResponse implements MarketplaceResponseInterface
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
