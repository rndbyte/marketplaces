<?php

declare(strict_types=1);

namespace Marketplaces\Contracts;

interface Service
{
    public function sendRequest(Request $request): mixed;
}
