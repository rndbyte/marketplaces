<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Wildberries\Enums;

use Marketplaces\Modules\Wildberries\Exceptions\InternalException;
use Marketplaces\Modules\Wildberries\Exceptions\BadRequestException;
use Marketplaces\Modules\Wildberries\Exceptions\UnauthorizedException;
use Marketplaces\Modules\Wildberries\Exceptions\AccessDeniedException;

final class ApiErrors
{
    public const BAD_REQUEST = 400;
    public const UNAUTHORIZED = 401;
    public const ACCESS_DENIED = 403;
    public const INTERNAL_ERROR = 500;

    public static function getExceptionsList(): array
    {
        return [
            self::BAD_REQUEST => BadRequestException::class,
            self::UNAUTHORIZED => UnauthorizedException::class,
            self::ACCESS_DENIED => AccessDeniedException::class,
            self::INTERNAL_ERROR => InternalException::class,
        ];
    }
}
