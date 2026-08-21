<?php

namespace Lemonade\ObjectQuery\Tests\Unit\Definition;

use Lemonade\ObjectQuery\Definition\Nested;
use Lemonade\ObjectQuery\Definition\Path;
use Lemonade\ObjectQuery\DefinitionInterface;
use Lemonade\ObjectQuery\Query\Query;
use Lemonade\ObjectQuery\QueryResolver;
use Lemonade\ObjectQuery\Source\ObjectSource;
use PHPUnit\Framework\TestCase;

class NestedTest extends TestCase
{
    /**
     * @test
     */
    public function itCanBeConstructed(): void
    {
        $actual = new Nested(new Path());

        $this->assertInstanceOf(DefinitionInterface::class, $actual);
    }

    /**
     * @test
     */
    public function itShouldResolveANestedObject(): void
    {
        $pilot = (object) ['name' => 'Han Solo', 'id' => 1002];
        $ship  = (object) ['name' => 'Millenium Falcon', 'pilot' => $pilot];

        $resolver = new QueryResolver(
            new Query('name', (new Path())->get('name')),
            new Query('pilot', new Nested(
                (new Path())->get('pilot'),
                new Query('name', (new Path())->get('name')),
                new Query('id', (new Path())->get('id'))
            ))
        );

        $result = $resolver->resolve(new ObjectSource($ship));

        $this->assertSame(
            [
                'name'  => 'Millenium Falcon',
                'pilot' => ['name' => 'Han Solo', 'id' => 1002],
            ],
            $result
        );
    }

    /**
     * @test
     */
    public function itShouldResolveANestedListOfObjects(): void
    {
        $ship = (object) [
            'name' => 'Millenium Falcon',
            'crew' => [
                (object) ['name' => 'Han Solo'],
                (object) ['name' => 'Chewbacca'],
            ],
        ];

        $resolver = new QueryResolver(
            new Query('crew', new Nested(
                (new Path())->get('crew'),
                new Query('name', (new Path())->get('name'))
            ))
        );

        $result = $resolver->resolve(new ObjectSource($ship));

        $this->assertSame(
            ['crew' => [['name' => 'Han Solo'], ['name' => 'Chewbacca']]],
            $result
        );
    }

    /**
     * @test
     */
    public function itShouldSupportDeeplyNestedStructures(): void
    {
        $engine = (object) ['power' => 'strong'];
        $pilot  = (object) ['name' => 'Han Solo', 'ship' => (object) ['name' => 'Falcon', 'engine' => $engine]];

        $resolver = new QueryResolver(
            new Query('name', (new Path())->get('name')),
            new Query('ship', new Nested(
                (new Path())->get('ship'),
                new Query('name', (new Path())->get('name')),
                new Query('engine', new Nested(
                    (new Path())->get('engine'),
                    new Query('power', (new Path())->get('power'))
                ))
            ))
        );

        $result = $resolver->resolve(new ObjectSource($pilot));

        $this->assertSame(
            [
                'name' => 'Han Solo',
                'ship' => [
                    'name'   => 'Falcon',
                    'engine' => ['power' => 'strong'],
                ],
            ],
            $result
        );
    }

    /**
     * @test
     */
    public function itShouldPropagateAnUnresolvedNavigationValue(): void
    {
        $ship = (object) ['name' => 'Millenium Falcon'];

        $resolver = new QueryResolver(
            new Query('name', (new Path())->get('name')),
            new Query('pilot', new Nested(
                (new Path())->get('pilot')->get('name')->optional(),
                new Query('name', (new Path())->get('name'))
            ))
        );

        $result = $resolver->resolve(new ObjectSource($ship));

        $this->assertSame(['name' => 'Millenium Falcon'], $result);
    }
}
