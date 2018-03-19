<?php

namespace ObjectQuery\Test\Unit;

use ObjectQuery\QueryResolver;
use ObjectQuery\QueryResolverInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class QueryResolverTest
 * @package ObjectQuery\Test\Unit
 * @author Christian Blank <christian@cubicl.de>
 */
class QueryResolverTest extends TestCase
{
    /**
     * @test
     */
    public function itCanBeConstructed()
    {
        $resolver = new QueryResolver();

        $this->assertInstanceOf(QueryResolverInterface::class, $resolver);
    }
}
