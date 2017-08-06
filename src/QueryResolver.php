<?php

namespace ObjectQuery;

use ObjectQuery\Resolver\ResolverInterface;

/**
 * Class QueryResolver
 *
 * @package ObjectQuery
 * @author Christian Blank <christian@cubicl.de>
 */
class QueryResolver implements QueryResolverInterface
{
    /**
     * @inheritdoc
     */
    public function resolve(QueryInterface $query, ResolverInterface $rootResolver): array
    {
        return [];
    }
}