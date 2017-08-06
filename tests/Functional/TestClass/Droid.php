<?php

namespace ObjectQuery\Test\Functional\TestClass;

/**
 * Class Droid
 *
 * @package ObjectQuery\Test\Functional\TestClass
 * @author Christian Blank <christian@cubicl.de>
 */
class Droid implements CharacterInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int[]
     */
    private $friends;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Episode[]
     */
    private $appearsIn;

    /**
     * @var string
     */
    private $primaryFunction;

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


    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return $this->name;
    }

    public function friends()
    {
        return array_map(function ($id) {return DataBuilder::getCharacter($id);}, $this->friends);
    }

    public function appearsIn()
    {
        return $this->appearsIn;
    }

    public function primaryFunction()
    {
        return $this->primaryFunction;
    }
}