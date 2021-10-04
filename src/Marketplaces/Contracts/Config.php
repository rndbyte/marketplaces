<?php

declare(strict_types=1);

namespace Marketplaces\Contracts;

interface Config
{
    public function getApiKey(): string;
    public function getClientId(): string;
    public function getHttpHeaders(): array;
    public function getSecretToken(): string;
    public function getApiEndpoint(): string;
}
