<?php

namespace ObjectQuery\Test\Functional;

use ObjectQuery\Definition\Composition;
use ObjectQuery\Definition\Path;
use ObjectQuery\Definition\Value;
use ObjectQuery\Query\Query;
use ObjectQuery\QueryResolver;
use ObjectQuery\Source\ObjectSource;
use ObjectQuery\Test\Functional\TestClass\DataBuilder;
use ObjectQuery\Test\Functional\TestClass\Episode;
use ObjectQuery\Test\Functional\TestClass\EpisodeFilter;
use ObjectQuery\Test\Functional\TestClass\IdTransformer;
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

    protected function setUp(): void
    {
        $this->dataBuilder = new DataBuilder();
    }

    /**
     * @test
     */
    public function itShouldResolveTheNameQuery(): void
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
    public function itShouldResolveTheNestedEpisodesQuery(): void
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
    public function itShouldResolveFlatQueryWithMultipleStarts(): void
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

    /**
     * @test
     */
    public function itShouldReturnAValueObjectAsItWasStored(): void
    {
        $resolver = new QueryResolver(
            new Query('someKey', new Value('foo'))
        );

        $actual = $resolver->resolveArray($this->dataBuilder->getStarShip(3000));

        $this->assertSame(['someKey' => 'foo'], $actual);
    }

    /**
     * @test
     */
    public function itShouldReturnTheResultOfTheComposition(): void
    {
        $composition = new Composition(function(ObjectSource $source) {
            return $source->get('id');
        });
        $resolver = new QueryResolver(
            new Query('someKey', $composition)
        );

        $actual = $resolver->resolveArray($this->dataBuilder->getStarShip(3000));

        $this->assertSame(['someKey' => 3000], $actual);
    }

    /**
     * @test
     */
    public function itShouldTransformValue(): void
    {
        $resolver = new QueryResolver(
            new Query('lukes ID', (new Path())->get('id')->transform(new IdTransformer()))
        );

        $result = $resolver->resolveArray($this->dataBuilder->getCharacter(1000));

        $this->assertSame(['lukes ID' => 1001], $result);
    }

    /**
     * @test
     */
    public function itShouldFilterEpisodes(): void
    {
        $resolver = new QueryResolver(
            new Query(
                'episodes',
                (new Path())
                    ->get('appearsIn')
                    ->filter(new EpisodeFilter(Episode::EMPIRE))
                    ->get('episode'))
        );

        $result = $resolver->resolveArray($this->dataBuilder->getCharacter(1000));

        $this->assertSame(['episodes' => [1, 2]], $result);
    }
}
