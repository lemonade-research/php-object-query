<?php

namespace ObjectQuery\Query;

use ObjectQuery\DefinitionInterface;
use ObjectQuery\QueryInterface;

/**
 * Class Query
 *
 * @package ObjectQuery
 * @author  Christian Blank <christian@cubicl.de>
 */
final class Query implements QueryInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var DefinitionInterface
     */
    private $definition;

    /**
     * @param string              $name
     * @param DefinitionInterface $definition
     */
    public function __construct(string $name, DefinitionInterface $definition)
    {
        $this->name = $name;
        $this->definition = $definition;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return DefinitionInterface
     */
    public function getDefinition(): DefinitionInterface
    {
        return $this->definition;
    }
}
