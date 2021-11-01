<?php

declare(strict_types=1);

namespace Marketplaces\Components\Support;

class Validator
{
    public static function validateUrl(string $url): bool
    {
        // TODO must require ending without slash
        $result = filter_var($url, FILTER_VALIDATE_URL);
        return gettype($result) === 'string';
    }
}
