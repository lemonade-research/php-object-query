<?php

namespace ObjectQuery\Test\Unit\Definition;

use ObjectQuery\Definition\Path;
use ObjectQuery\DefinitionInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class PathTest
 *
 * @package ObjectQuery\Test\Unit\Definition
 * @author  Christian Blank <christian@cubicl.de>
 */
class PathTest extends TestCase
{
    /**
     * @test
     */
    public function itCanBeConstructed()
    {
        $actual = new Path();

        $this->assertInstanceOf(DefinitionInterface::class, $actual);
    }
}
