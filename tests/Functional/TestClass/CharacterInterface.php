<?php

namespace Lemonade\ObjectQuery\Tests\Functional\TestClass;

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
