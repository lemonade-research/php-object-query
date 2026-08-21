<?php

namespace Lemonade\ObjectQuery\Definition;

use Lemonade\ObjectQuery\DefinitionInterface;
use Lemonade\ObjectQuery\QueryInterface;
use Lemonade\ObjectQuery\QueryResolver;
use Lemonade\ObjectQuery\Source\ArraySource;
use Lemonade\ObjectQuery\Source\ObjectSource;
use Lemonade\ObjectQuery\SourceInterface;

/**
 * Resolves one or more queries against a sub-source, allowing the resolver
 * to build nested data structures instead of a flat associative array.
 *
 * The given definition (typically a Path) is used to navigate to the
 * sub-source first. Depending on what it resolves to, the nested queries
 * are then applied either to a single object (resulting in a nested
 * associative array) or to every entry of a collection (resulting in a
 * list of nested associative arrays).
 */
final class Nested implements DefinitionInterface
{
    /** @var QueryInterface[] */
    private array $queries;

    public function __construct(private readonly DefinitionInterface $definition, QueryInterface ...$queries)
    {
        $this->queries = $queries;
    }

    public function getValue(SourceInterface $source): mixed
    {
        $target = $this->definition->getValue($source);

        if ($target instanceof UnresolvedValue) {
            return $target;
        }

        if ($target instanceof ArraySource) {
            return array_map(
                fn (mixed $entry) => $this->resolveEntry($entry),
                $target->getSource()
            );
        }

        if ($target instanceof SourceInterface) {
            return $this->resolver()->resolve($target);
        }

        return $target;
    }

    private function resolveEntry(mixed $entry): mixed
    {
        if (is_object($entry)) {
            return $this->resolver()->resolve(new ObjectSource($entry));
        }

        if (is_array($entry)) {
            return $this->resolver()->resolve(new ArraySource($entry));
        }

        return $entry;
    }

    private function resolver(): QueryResolver
    {
        return new QueryResolver(...$this->queries);
    }
}
