<?php

namespace ObjectQuery;

use ObjectQuery\Node\CollectionNode;
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
        $result = [];

        foreach ($query->getProperties() as $key => $propertyPath) {
            $pathParts = explode('.', $propertyPath);
            $rootData = $rootResolver->getRoot(array_shift($pathParts));

            if ($rootData instanceof CollectionNode) {
                foreach ($rootData->getCollection() as $entry) {
                    $result[] = $this->value();
                }
            }
        }
        
        return $result;
    }

    private function value()
    {
    }


}