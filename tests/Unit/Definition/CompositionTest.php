<?php

namespace ObjectQuery\Test\Unit\Definition;

use ObjectQuery\Definition\Composition;
use ObjectQuery\DefinitionInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class CompositionTest
 *
 * @package ObjectQuery\Test\Unit\Definition
 * @author  Christian Blank <christian@cubicl.de>
 */
class CompositionTest extends TestCase
{
    /**
     * @test
     */
    public function itCanBeConstructed(): void
    {
        $actual = new Composition(function() {});

        $this->assertInstanceOf(DefinitionInterface::class, $actual);
    }
}
