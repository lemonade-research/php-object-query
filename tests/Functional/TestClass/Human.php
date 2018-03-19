<?php

namespace ObjectQuery\Test\Functional\TestClass;

/**
 * Class Human
 *
 * @package ObjectQuery\Test\Functional\TestClass
 * @author  Christian Blank <christian@cubicl.de>
 */
class Human implements CharacterInterface
{
    /**
     * @var double
     */
    private $height;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int[]
     */
    private $friends;

    /**
     * @var Episode[]
     */
    private $appearsIn;

    /**
     * @var int
     */
    private $mass;

    /**
     * @var StarShip[]
     */
    private $starShips;

    /**
     * Human constructor.
     *
     * @param float      $height
     * @param int        $id
     * @param string     $name
     * @param int[]      $friends
     * @param Episode[]  $appearsIn
     * @param int        $mass
     * @param StarShip[] $starShips
     */
    public function __construct($id, $name, $height, $mass, array $friends, array $appearsIn, array $starShips)
    {
        $this->height = $height;
        $this->id = $id;
        $this->name = $name;
        $this->friends = $friends;
        $this->appearsIn = $appearsIn;
        $this->mass = $mass;
        $this->starShips = $starShips;
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

    public function height(LengthUnit $unit)
    {
        if ($unit->getUnit() === LengthUnit::FOOT) {
            return $this->height * 3.28084;
        }

        return $this->height;
    }

    public function mass()
    {
        return $this->mass;

    }

    public function starShips()
    {
        return $this->starShips;

    }
}
