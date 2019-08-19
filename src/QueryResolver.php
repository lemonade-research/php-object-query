<?php

namespace ObjectQuery;

use ObjectQuery\Source\ArraySource;
use ObjectQuery\Source\ObjectSource;
use Throwable;

/**
 * Class QueryResolver
 *
 * @package ObjectQuery
 * @author Christian Blank <christian@cubicl.de>
 */
final class QueryResolver implements QueryResolverInterface
{
    /** @var QueryInterface[] */
    private $queries = [];

    /**
     * @param QueryInterface ...$queries
     */
    public function __construct(QueryInterface ...$queries)
    {
        $this->queries = $queries;
    }

    public function resolve(SourceInterface $source): array
    {
        return $this->map($source);
    }

    /**
     * @param SourceInterface $source
     *
     * @return array
     * @throws Throwable
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
