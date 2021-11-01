<?php

declare(strict_types=1);

namespace Marketplaces\Modules\YandexMarket\Enums;

use Marketplaces\Modules\YandexMarket\Exceptions\NotFoundException;
use Marketplaces\Modules\YandexMarket\Exceptions\InternalException;
use Marketplaces\Modules\YandexMarket\Exceptions\BadRequestException;
use Marketplaces\Modules\YandexMarket\Exceptions\AccessDeniedException;
use Marketplaces\Modules\YandexMarket\Exceptions\UnauthorizedException;
use Marketplaces\Modules\YandexMarket\Exceptions\EnhanceYourCalmException;
use Marketplaces\Modules\YandexMarket\Exceptions\MethodNotAllowedException;
use Marketplaces\Modules\YandexMarket\Exceptions\UnsupportedMediaTypeException;

final class ApiErrors
{
    public const ACCESS_DENIED = '403';
    public const BAD_REQUEST = '400';
    public const UNAUTHORIZED = '401';
    public const NOT_FOUND = '404';
    public const METHOD_NOT_ALLOWED = '405';
    public const UNSUPPORTED_MEDIA_TYPE = '415';
    public const ENHANCE_YOUR_CALM = '420';
    public const INTERNAL_ERROR = '503';

    public static function getExceptionsList(): array
    {
        return [
            self::ACCESS_DENIED => AccessDeniedException::class,
            self::BAD_REQUEST => BadRequestException::class,
            self::UNAUTHORIZED => UnauthorizedException::class,
            self::NOT_FOUND => NotFoundException::class,
            self::METHOD_NOT_ALLOWED => MethodNotAllowedException::class,
            self::UNSUPPORTED_MEDIA_TYPE => UnsupportedMediaTypeException::class,
            self::ENHANCE_YOUR_CALM => EnhanceYourCalmException::class,
            self::INTERNAL_ERROR => InternalException::class,
        ];
    }
}
