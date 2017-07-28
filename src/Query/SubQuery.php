<?php

namespace ObjectQuery\Query;

use ObjectQuery\QueryInterface;

/**
 * Internal class
 *
 * @package ObjectQuery\Query
 * @author Christian Blank <christian@cubicl.de>
 */
class SubQuery
{
    /**
     * @var QueryInterface
     */
    private $subQuery;

    /**
     * @var string
     */
    private $propertyPath;

    /**
     * SubQuery constructor.
     * @param QueryInterface $subQuery
     * @param string $propertyPath
     */
    public function __construct(QueryInterface $subQuery, string $propertyPath)
    {
        $this->subQuery = $subQuery;
        $this->propertyPath = $propertyPath;
    }

    /**
     * @return QueryInterface
     */
    public function getSubQuery(): QueryInterface
    {
        return $this->subQuery;
    }

    /**
     * @return string
     */
    public function getPropertyPath(): string
    {
        return $this->propertyPath;
    }
}