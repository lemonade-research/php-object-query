<?php

namespace Lemonade\ObjectQuery\Definition;

use Lemonade\ObjectQuery\DefinitionInterface;
use Lemonade\ObjectQuery\SourceInterface;

final class Value implements DefinitionInterface
{
    public function __construct(private readonly mixed $value)
    {
    }

    public function getValue(SourceInterface $source): mixed
    {
        return $this->value;
    }
}
