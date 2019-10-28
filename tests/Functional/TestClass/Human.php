<?php

namespace Cubicl\ObjectQuery\Tests\Functional\TestClass;

/**
 * Class Human
 *
 * @package Cubicl\ObjectQuery\Tests\Functional\TestClass
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
    public function __construct(
        int $id,
        string $name,
        float $height,
        int $mass,
        array $friends,
        array $appearsIn,
        array $starShips
    ) {
        $this->height    = $height;
        $this->id        = $id;
        $this->name      = $name;
        $this->friends   = $friends;
        $this->appearsIn = $appearsIn;
        $this->mass      = $mass;
        $this->starShips = $starShips;
    }

    /**
     * @var StarShip[]
     */
    private $starShips;

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return CharacterInterface[]
     */
    public function friends(): array
    {
        return array_map(
            function ($id) {
                return (new DataBuilder())->getCharacter($id);
            },
            $this->friends
        );
    }

    /**
     * @return Episode[]
     */
    public function appearsIn(): array
    {
        return $this->appearsIn;
    }

    public function height(LengthUnit $unit): float
    {
        if ($unit->getUnit() === LengthUnit::FOOT) {
            return $this->height * 3.28084;
        }

        return $this->height;
    }

    public function mass(): int
    {
        return $this->mass;
    }

    /**
     * @return StarShip[]
     */
    public function starShips(): array
    {
        return $this->starShips;
    }
}
