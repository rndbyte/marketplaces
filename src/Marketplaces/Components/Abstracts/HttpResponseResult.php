<?php

declare(strict_types=1);

namespace Marketplaces\Components\Abstracts;

use stdClass;
use JsonException;
use Marketplaces\Contracts\Result;
use Marketplaces\Components\Exceptions\MarketplaceException;

abstract class HttpResponseResult implements Result
{
    protected function __construct(protected stdClass $payload)
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

    /**
     * @param string $jsonString
     * @return static
     * @throws MarketplaceException
     */
    public static function fromJson(string $jsonString): static
    {
        try {
            return new static(json_decode(
                json: $jsonString,
                associative: false,
                flags: JSON_THROW_ON_ERROR
            ));
        } catch (JsonException $e) {
            throw new MarketplaceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function __isset(string $name): bool
    {
        return isset($this->payload->{$name});
    }

    public function __unset(string $name): void
    {
        unset($this->payload->{$name});
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
