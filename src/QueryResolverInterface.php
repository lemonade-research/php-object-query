<?php

namespace ObjectQuery;

use ObjectQuery\Resolver\ResolverInterface;

/**
 * Interface QueryResolverInterface
 * @package ObjectQuery
 * @author Christian Blank <christian@cubicl.de>
 */
interface QueryResolverInterface
{
    /**
     * @param QueryInterface $query
     * @param ResolverInterface $rootResolver
     * @return array
     */
    public function resolve(QueryInterface $query, ResolverInterface $rootResolver): array;
}