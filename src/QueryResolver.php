<?php

namespace Lemonade\ObjectQuery;

use Throwable;

final class QueryResolver implements QueryResolverInterface
{
    /** @var QueryInterface[] */
    private array $queries;

    public function __construct(QueryInterface ...$queries)
    {
        $this->queries = $queries;
    }

    /**
     * @return array<string, mixed>
     */
    public function resolve(SourceInterface $source): array
    {
        return $this->map($source);
    }

    /**
     * @return array<string, mixed>
     */
    private function map(SourceInterface $source): array
    {
        $target = [];

        foreach ($this->queries as $query) {
            try {
                $target[$query->getName()] = $query->getDefinition()->getValue($source);
            } catch (Throwable $e) {
                throw $e;
            }
        }

        return $target;
    }
}
