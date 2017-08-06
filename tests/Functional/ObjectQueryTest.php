<?php

namespace ObjectQuery\Test\Functional;

use ObjectQuery\QueryBuilder;
use ObjectQuery\QueryResolver;
use ObjectQuery\QueryResolverInterface;
use ObjectQuery\Resolver\ResolverInterface;
use ObjectQuery\Test\Functional\TestClass\DataBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Class ObjectQueryTest
 *
 * @package ObjectQuery\Test\Functional
 * @author Christian Blank <christian@cubicl.de>
 */
class ObjectQueryTest extends TestCase
{
    /**
     * @var ResolverInterface
     */
    private $rootResolver;

    /**
     * @var QueryResolverInterface
     */
    private $queryResolver;

    /**
     * @var QueryBuilder
     */
    private $queryBuilder;

    /**
     *
     */
    protected function setUp()
    {
        $this->queryResolver = new QueryResolver();
        $this->queryBuilder = QueryBuilder::create();
        $this->rootResolver = new DataBuilder();
    }

    /**
     * @test
     */
    public function itShouldResolveTheQuery()
    {
        $query = $this->queryBuilder->withProperty('name', 'hero.name')->build();

        $result = $this->queryResolver->resolve($query, $this->rootResolver);

        $this->assertCount(2, $result);
        $this->assertSame(['name' => 'Luke Skywalker'], $result[0]);
        $this->assertSame(['name' => 'R2-D2'], $result[1]);
    }
}