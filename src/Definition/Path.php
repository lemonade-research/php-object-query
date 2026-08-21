<?php

namespace Lemonade\ObjectQuery\Definition;

use Lemonade\ObjectQuery\DefinitionInterface;
use Lemonade\ObjectQuery\Exception\UnresolvablePathException;
use Lemonade\ObjectQuery\PredicateInterface;
use Lemonade\ObjectQuery\Source\ArraySource;
use Lemonade\ObjectQuery\SourceInterface;
use Lemonade\ObjectQuery\TransformerInterface;
use Throwable;

final class Path implements DefinitionInterface
{
    /** @var array<PredicateInterface|TransformerInterface|string>  */
    private array $operations = [];

    private bool $optional = false;

    private bool $hasDefault = false;

    private mixed $default = null;

    public function getValue(SourceInterface $source): mixed
    {
        try {
            return $this->resolve($source);
        } catch (Throwable $e) {
            if ($this->hasDefault) {
                return $this->default;
            }

            if ($this->optional) {
                return UnresolvedValue::instance();
            }

            throw $e;
        }
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

    /**
     * Marks the field as optional. If the path cannot be resolved (e.g. a
     * property is missing anywhere along the way), the resolver will omit
     * the corresponding key from the result set instead of throwing.
     */
    public function optional(): Path
    {
        $clone = clone $this;
        $clone->optional = true;

        return $clone;
    }

    /**
     * Provides a fallback value to use when the path cannot be resolved
     * (e.g. a property is missing anywhere along the way), instead of
     * throwing or omitting the key from the result set. Takes precedence
     * over optional().
     */
    public function default(mixed $value): Path
    {
        $clone = clone $this;
        $clone->hasDefault = true;
        $clone->default = $value;

        return $clone;
    }

    private function resolve(SourceInterface $source): mixed
    {
        $step = $source;

        foreach ($this->operations as $operation) {
            if ($operation instanceof PredicateInterface) {
                $step = new ArraySource(array_filter($step->getSource(), $operation));
            } elseif ($operation instanceof TransformerInterface) {
                return $operation->transform($step);
            } else {
                if (!$step instanceof SourceInterface) {
                    throw UnresolvablePathException::forProperty($operation);
                }

                $step = $step->get($operation);
            }
        }

        return $step;
    }
}
