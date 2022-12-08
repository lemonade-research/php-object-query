<?php

namespace Lemonade\ObjectQuery\Tests\Unit;

use Lemonade\ObjectQuery\QueryResolver;
use Lemonade\ObjectQuery\QueryResolverInterface;
use PHPUnit\Framework\TestCase;

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
