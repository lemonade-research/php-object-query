<?php

namespace Lemonade\ObjectQuery\Definition;

use Lemonade\ObjectQuery\DefinitionInterface;
use Lemonade\ObjectQuery\PredicateInterface;
use Lemonade\ObjectQuery\Source\ArraySource;
use Lemonade\ObjectQuery\SourceInterface;
use Lemonade\ObjectQuery\TransformerInterface;

final class Path implements DefinitionInterface
{
    /** @var array<PredicateInterface|TransformerInterface|string>  */
    private array $operations = [];

    public function getValue(SourceInterface $source): mixed
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
