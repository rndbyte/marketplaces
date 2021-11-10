<?php

declare(strict_types=1);

namespace Marketplaces\Components\Factories;

use ReflectionClass;
use InvalidArgumentException;
use Marketplaces\Contracts\FactoryInterface;
use Marketplaces\Contracts\MarketplaceResponseInterface;
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
    public function create(): MarketplaceResponseInterface
    {
        try {
            $reflect = new ReflectionClass($this->className);

            if ($reflect->implementsInterface(MarketplaceResponseInterface::class)) {
                /** @var MarketplaceResponseInterface $obj */
                $obj = $reflect->newInstance(json_decode(
                    json: $this->jsonString,
                    associative: false,
                    flags: JSON_THROW_ON_ERROR
                ));

                return $obj;
            } else {
                throw new InvalidArgumentException('Provided class must implement ' . MarketplaceResponseInterface::class);
            }
        } catch (\Exception $e) {
            throw new MarketplaceException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
