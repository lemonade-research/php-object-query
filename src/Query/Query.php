<?php

namespace Cubicl\ObjectQuery\Query;

use Cubicl\ObjectQuery\DefinitionInterface;
use Cubicl\ObjectQuery\QueryInterface;

/**
 * Class Query
 *
 * @package Cubicl\ObjectQuery
 * @author  Christian Blank <christian@cubicl.de>
 */
final class Query implements QueryInterface
{
    /** @var string */
    private $name;

    /** @var DefinitionInterface */
    private $definition;

    public function __construct(string $name, DefinitionInterface $definition)
    {
        $this->name = $name;
        $this->definition = $definition;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDefinition(): DefinitionInterface
    {
        return $this->definition;
    }
}
