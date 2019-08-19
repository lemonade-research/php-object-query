<?php

namespace ObjectQuery\Test\Functional\TestClass;

/**
 * Interface CharacterInterface
 *
 * @package ObjectQuery\Test\Functional\TestClass
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
