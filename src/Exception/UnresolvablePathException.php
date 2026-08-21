<?php

namespace Lemonade\ObjectQuery\Exception;

use RuntimeException;

final class UnresolvablePathException extends RuntimeException
{
    public static function forProperty(string $property): self
    {
        return new self(sprintf(
            'Unable to resolve property "%s". Use Path::optional() to allow missing fields.',
            $property
        ));
    }
}
