<?php

namespace Cubicl\ObjectQuery\Tests\Unit\Definition;

use Cubicl\ObjectQuery\Definition\Composition;
use Cubicl\ObjectQuery\DefinitionInterface;
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
        $actual = new Composition(function () {
        });

        $this->assertInstanceOf(DefinitionInterface::class, $actual);
    }
}
