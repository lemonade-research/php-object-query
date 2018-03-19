<?php

namespace ObjectQuery\Definition;

use ObjectQuery\DefinitionInterface;
use ObjectQuery\SourceInterface;

/**
 * Immutable path object
 *
 * @package ObjectQuery\Definition
 * @author  Christian Blank <christian@cubicl.de>
 */
final class Path implements DefinitionInterface
{
    /**
     * @var string[]
     */
    private $operations = [];

    /**
     * @param SourceInterface $source
     *
     * @return mixed
     */
    public function getValue(SourceInterface $source)
    {
        foreach ($this->operations as $operation) {
            return $source->get($operation);
        }
    }

    /**
     * @param string $property
     *
     * @return Path
     */
    public function get(string $property): Path
    {
        $clone = clone $this;
        $clone->operations[] = $property;

        return $clone;
    }

}
