<?php

declare(strict_types=1);

namespace Marketplaces\Components\Exceptions;

use Exception;
use Stringable;

class MarketplaceException extends Exception implements Stringable
{
    public function __toString():string
    {
        return __CLASS__ . ': [' . $this->getCode() . ']: [' . $this->getMessage() . ']';
    }
}
