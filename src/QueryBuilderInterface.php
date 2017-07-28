<?php

namespace ObjectQuery;

/**
 *
 *
 * @package ObjectQuery
 * @author Christian Blank <christian@cubicl.de>
 */
interface QueryBuilderInterface
{
    /**
     * @return QueryInterface
     */
    public function build(): QueryInterface;

    /**
     * @param string $propertyName
     * @param string $propertyPath
     * @return QueryBuilderInterface
     */
    public function withProperty(string $propertyName, string $propertyPath): QueryBuilderInterface;

    /**
     * @param string $propertyName
     * @param string $propertyPath
     * @param QueryInterface $subQuery
     * @return QueryBuilderInterface
     */
    public function withSubQuery(string $propertyName, string $propertyPath, QueryInterface $subQuery): QueryBuilderInterface;
}