<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Enums;

use Marketplaces\Modules\Ozon\Exceptions\NotFoundException;
use Marketplaces\Modules\Ozon\Exceptions\InternalException;
use Marketplaces\Modules\Ozon\Exceptions\BadRequestException;
use Marketplaces\Modules\Ozon\Exceptions\ValidationException;
use Marketplaces\Modules\Ozon\Exceptions\AccessDeniedException;
use Marketplaces\Modules\Ozon\Exceptions\RequestTimeoutException;
use Marketplaces\Modules\Ozon\Exceptions\NotFoundInSortingCenterException;

final class ApiErrors
{
    public const ACCESS_DENIED = 'ACCESS_DENIED';
    public const BAD_REQUEST = 'BAD_REQUEST';
    public const INTERNAL_ERROR = 'INTERNAL_ERROR';
    public const NOT_FOUND_ERROR = 'NOT_FOUND_ERROR';
    public const NOT_FOUND_IN_SORTING_CENTER = 'NOT_FOUND_IN_SORTING_CENTER';
    public const VALIDATION_ERROR = 'VALIDATION_ERROR';
    public const REQUEST_TIMEOUT = 'REQUEST_TIMEOUT';

    public static function getExceptionsList(): array
    {
        return [
            self::ACCESS_DENIED => AccessDeniedException::class,
            self::BAD_REQUEST => BadRequestException::class,
            self::NOT_FOUND_ERROR => NotFoundException::class,
            self::INTERNAL_ERROR => InternalException::class,
            self::NOT_FOUND_IN_SORTING_CENTER => NotFoundInSortingCenterException::class,
            self::VALIDATION_ERROR => ValidationException::class,
            self::REQUEST_TIMEOUT => RequestTimeoutException::class,
        ];
    }
}
