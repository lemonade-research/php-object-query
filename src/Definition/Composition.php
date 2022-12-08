<?php

namespace Lemonade\ObjectQuery\Definition;

use Closure;
use Lemonade\ObjectQuery\DefinitionInterface;
use Lemonade\ObjectQuery\SourceInterface;

final class Composition implements DefinitionInterface
{
    public function __construct(private readonly Closure $compositor)
    {
    }

    public function getValue(SourceInterface $source): mixed
    {
        return call_user_func($this->compositor, $source);
    }
}
