<?php

declare(strict_types=1);

namespace Marketplaces\Components\Support;

use ReflectionClass;
use InvalidArgumentException;
use Marketplaces\Contracts\FactoryInterface;
use Marketplaces\Contracts\ResponseInterface;
use Marketplaces\Components\Exceptions\MarketplaceException;

class ResponseResultFactory implements FactoryInterface
{
    public function __construct(private string $className, private string $jsonString)
    {
    }

    public static function new(string $className, string $jsonString): self
    {
        return new self($className, $jsonString);
    }

    /**
     * @throws MarketplaceException
     */
    public function create(): ResponseInterface
    {
        try {
            $reflect = new ReflectionClass($this->className);

            if ($reflect->implementsInterface(ResponseInterface::class)) {
                /** @var ResponseInterface $obj */
                $obj = $reflect->newInstance(json_decode(
                    json: $this->jsonString,
                    associative: false,
                    flags: JSON_THROW_ON_ERROR
                ));

                return $obj;
            } else {
                throw new InvalidArgumentException('Provided class must implement ' . ResponseInterface::class);
            }
        } catch (\Exception $e) {
            throw new MarketplaceException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
