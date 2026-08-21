<?php

namespace Lemonade\ObjectQuery\Tests\Unit\Definition;

use Lemonade\ObjectQuery\Definition\Path;
use Lemonade\ObjectQuery\DefinitionInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class PathTest
 *
 * @package Cubicl\ObjectQuery\Tests\Unit\Definition
 * @author  Christian Blank <christian@cubicl.de>
 */
class PathTest extends TestCase
{
    /**
     * @test
     */
    public function itCanBeConstructed(): void
    {
        $actual = new Path();

        $this->assertInstanceOf(DefinitionInterface::class, $actual);
    }

    /**
     * @test
     */
    public function optionalReturnsANewInstance(): void
    {
        $path = new Path();

        $actual = $path->optional();

        $this->assertInstanceOf(Path::class, $actual);
        $this->assertNotSame($path, $actual);
    }
}
