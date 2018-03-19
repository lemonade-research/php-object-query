<?php

namespace ObjectQuery\Test\Functional;

use ObjectQuery\Definition\Path;
use ObjectQuery\Query\Query;
use ObjectQuery\QueryResolver;
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
     * @var DataBuilder
     */
    private $dataBuilder;

    protected function setUp()
    {
        parent::setUp();

        $this->dataBuilder = new DataBuilder();
    }

    /**
     * @test
     */
    public function itShouldResolveTheNameQuery()
    {
        $resolver = new QueryResolver(
            new Query('name', (new Path())->get('name'))
        );

        $result = $resolver->resolveArray($this->dataBuilder->getCharacter(1000));

        $this->assertSame(['name' => 'Luke Skywalker'], $result);
    }
}
