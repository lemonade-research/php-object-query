<?php

namespace Lemonade\ObjectQuery\Tests\Unit\Definition;

use Lemonade\ObjectQuery\Definition\Composition;
use Lemonade\ObjectQuery\DefinitionInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class CompositionTest
 *
 * @package Cubicl\ObjectQuery\Tests\Unit\Definition
 * @author  Christian Blank <christian@cubicl.de>
 */
class CompositionTest extends TestCase
{
    /**
     * @test
     */
    public function itCanBeConstructed(): void
    {
        $actual = new Composition(fn() => []);

        $this->assertInstanceOf(DefinitionInterface::class, $actual);
    }
}
