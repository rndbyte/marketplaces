<?php

declare(strict_types=1);

namespace Marketplaces\Contracts;

interface MarketplaceServiceInterface
{
    public function sendRequest(MarketplaceRequestInterface $request): mixed;
}
