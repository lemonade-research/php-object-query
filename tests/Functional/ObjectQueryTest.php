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
 * @author  Christian Blank <christian@cubicl.de>
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

    /**
     * @test
     */
    public function itShouldResolveTheNestedEpisodesQuery()
    {
        $resolver = new QueryResolver(
            new Query('episodes', (new Path())->get('appearsIn')->get('episode'))
        );

        $result = $resolver->resolveArray($this->dataBuilder->getCharacter(1000));

        $this->assertSame(['episodes' => [1, 2, 3]], $result);
    }

    /**
     * @test
     */
    public function itShouldResolveFlatQueryWithMultipleStarts()
    {
        $resolver = new QueryResolver(
            new Query('shipNames', (new Path())->get('name'))
        );

        $result = $resolver->resolveArray(
            [
                $this->dataBuilder->getStarShip(3000),
                $this->dataBuilder->getStarShip(3001),
                $this->dataBuilder->getStarShip(3002),
                $this->dataBuilder->getStarShip(3003),
            ]
        );

        $this->assertSame(['shipNames' => ['Millenium Falcon', 'X-Wing', 'TIE Advanced x1', 'Imperial shuttle']], $result);
    }
}
