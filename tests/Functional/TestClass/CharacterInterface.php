<?php

namespace Cubicl\ObjectQuery\Tests\Functional\TestClass;

/**
 * Interface CharacterInterface
 *
 * @package Cubicl\ObjectQuery\Tests\Functional\TestClass
 * @author Christian Blank <christian@cubicl.de>
 */
interface CharacterInterface
{
    public function id(): int;

    public function name(): string;

    /**
     * @return CharacterInterface[]
     */
    public function friends(): array;

    /**
     * @return Episode[]
     */
    public function appearsIn(): array;
}
