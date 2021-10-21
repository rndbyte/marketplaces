<?php

declare(strict_types=1);

namespace Marketplaces\Modules\Ozon\Factories;

use InvalidArgumentException;
use Marketplaces\Contracts\FactoryInterface;
use Marketplaces\Modules\Ozon\DTO\ErrorResponse;

class ErrorResponseFactory implements FactoryInterface
{
    public static function new(): self
    {
        return new self();
    }

    public function create(array $errorData = null): ErrorResponse
    {
        if (!array_key_exists('error', $errorData) && is_array($errorData['error'])) {
            throw new InvalidArgumentException(
                'Invalid error data provided. Key "error" does not exists or not an array.'
            );
        }

        $error = $errorData['error'];

        $requiredKeys = array_keys(get_class_vars(ErrorResponse::class));

        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $error)) {
                throw new InvalidArgumentException('Key "' . $key .'" is missing from error array.');
            }
        }

        return new ErrorResponse(
            code: $error['code'],
            message: $error['message'],
            data: $error['data'],
        );
    }
}
