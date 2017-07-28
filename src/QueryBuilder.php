<?php

namespace ObjectQuery;

use ObjectQuery\Query\SubQuery;

/**
 * Class QueryBuilder
 * @package ObjectQuery
 * @author Christian Blank <christian@cubicl.de>
 */
class QueryBuilder implements QueryBuilderInterface
{
    /**
     * @var array
     */
    private $properties = [];

    /**
     * @inheritdoc
     */
    public function build(): QueryInterface
    {
        return new Query($this->properties);
    }

    /**
     * @inheritdoc
     */
    public function withProperty(string $propertyName, string $propertyPath): QueryBuilderInterface
    {
        $this->properties[$propertyName] = $propertyPath;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function withSubQuery(string $propertyName, string $propertyPath, QueryInterface $subQuery): QueryBuilderInterface
    {
        $this->properties[$propertyName] = new SubQuery($subQuery, $propertyPath);

        return $this;
    }
}