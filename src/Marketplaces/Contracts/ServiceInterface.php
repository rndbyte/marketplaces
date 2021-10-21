<?php

declare(strict_types=1);

namespace Marketplaces\Contracts;

interface ServiceInterface
{
    public function sendRequest(RequestInterface $request): mixed;
}
