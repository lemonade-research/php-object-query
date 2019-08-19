<?php

namespace Cubicl\ObjectQuery\Definition;

use Cubicl\ObjectQuery\DefinitionInterface;
use Cubicl\ObjectQuery\PredicateInterface;
use Cubicl\ObjectQuery\Source\ArraySource;
use Cubicl\ObjectQuery\SourceInterface;
use Cubicl\ObjectQuery\TransformerInterface;

/**
 * Immutable path object
 *
 * @package Cubicl\ObjectQuery\Definition
 * @author  Christian Blank <christian@cubicl.de>
 */
final class Path implements DefinitionInterface
{
    /**  @var array */
    private $operations = [];

    /**
     * @param SourceInterface $source
     *
     * @return mixed
     */
    public function getValue(SourceInterface $source)
    {
        $step = $source;

        foreach ($this->operations as $operation) {
            if ($operation instanceof PredicateInterface) {
                $step = new ArraySource(array_filter($step->getSource(), $operation));
            } elseif ($operation instanceof TransformerInterface) {
                return $operation->transform($step);
            } else {
                $step = $step->get($operation);
            }
        }

        return $step;
    }

    public function get(string $property): Path
    {
        $clone = clone $this;
        $clone->operations[] = $property;

        return $clone;
    }

    public function filter(PredicateInterface $predicate): Path
    {
        $clone = clone $this;
        $clone->operations[] = $predicate;

        return $clone;
    }

    public function transform(TransformerInterface $transformer): Path
    {
        $clone = clone $this;
        $clone->operations[] = $transformer;

        return $clone;
    }
}
