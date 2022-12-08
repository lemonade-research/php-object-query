<?php

namespace Lemonade\ObjectQuery\Tests\Functional\TestClass;

class Droid implements CharacterInterface
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var int[]
     */
    private array $friends;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var Episode[]
     */
    private array $appearsIn;

    /**
     * @var string
     */
    private string $primaryFunction;

    /**
     * Droid constructor.
     *
     * @param int $id
     * @param int[] $friends
     * @param string $name
     * @param Episode[] $appearsIn
     * @param string $primaryFunction
     */
    public function __construct($id, array $friends, $name, array $appearsIn, $primaryFunction)
    {
        $this->id = $id;
        $this->friends = $friends;
        $this->name = $name;
        $this->appearsIn = $appearsIn;
        $this->primaryFunction = $primaryFunction;
    }


    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function friends(): array
    {
        return array_map(function ($id) {
            return (new DataBuilder())->getCharacter($id);
        }, $this->friends);
    }

    /**
     * @inheritDoc
     */
    public function appearsIn(): array
    {
        return $this->appearsIn;
    }

    public function primaryFunction(): string
    {
        return $this->primaryFunction;
    }
}
