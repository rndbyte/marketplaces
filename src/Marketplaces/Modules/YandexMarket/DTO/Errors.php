<?php

declare(strict_types=1);

namespace Marketplaces\Modules\YandexMarket\DTO;

class Errors
{
    public function __construct(
        protected array $collection,
    )
    {
    }

    public function add(Error $error): static
    {
        $this->collection[] = $error;

        return $this;
    }

    public function getAll(): array
    {
        return $this->collection;
    }
}
