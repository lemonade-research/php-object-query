<?php

namespace Cubicl\ObjectQuery\Tests\Unit;

use Cubicl\ObjectQuery\QueryResolver;
use Cubicl\ObjectQuery\QueryResolverInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class QueryResolverTest
 * @package Cubicl\ObjectQuery\Tests\Unit
 * @author Christian Blank <christian@cubicl.de>
 */
class QueryResolverTest extends TestCase
{
    /**
     * @test
     */
    public function itCanBeConstructed(): void
    {
        $resolver = new QueryResolver();

        $this->assertInstanceOf(QueryResolverInterface::class, $resolver);
    }
}
