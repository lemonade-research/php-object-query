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
     * @var CharacterInterface[]
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
        return $this->friends;
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