<?php

namespace ObjectQuery\Definition;

use ObjectQuery\DefinitionInterface;
use ObjectQuery\PredicateInterface;
use ObjectQuery\Source\ArraySource;
use ObjectQuery\SourceInterface;
use ObjectQuery\TransformerInterface;

/**
 * Immutable path object
 *
 * @package ObjectQuery\Definition
 * @author  Christian Blank <christian@cubicl.de>
 */
final class Path implements DefinitionInterface
{
    /**
     * @var array
     */
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

    /**
     * @param PredicateInterface $predicate
     *
     * @return Path
     */
    public function filter(PredicateInterface $predicate): Path
    {
        $clone = clone $this;
        $clone->operations[] = $predicate;

        return $clone;
    }

    /**
     * @param TransformerInterface $transformer
     *
     * @return Path
     */
    public function transform(TransformerInterface $transformer): Path
    {
        $clone = clone $this;
        $clone->operations[] = $transformer;

        return $clone;
    }
}
