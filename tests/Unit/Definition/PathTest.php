<?php

namespace Cubicl\ObjectQuery\Tests\Unit\Definition;

use Cubicl\ObjectQuery\Definition\Path;
use Cubicl\ObjectQuery\DefinitionInterface;
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
}
