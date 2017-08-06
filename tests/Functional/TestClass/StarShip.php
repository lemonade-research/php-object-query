<?php

namespace ObjectQuery\Test\Functional\TestClass;

/**
 * Class Starship
 *
 * @package ObjectQuery\Test\Functional\TestClass
 * @author Christian Blank <christian@cubicl.de>
 */
class StarShip
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var double
     */
    private $length;

    /**
     * Starship constructor.
     *
     * @param int $id
     * @param string $name
     * @param float $height
     */
    public function __construct($id, $name, $height)
    {
        $this->id = $id;
        $this->name = $name;
        $this->length = $height;
    }

    /**
     * @return int
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @param LengthUnit $unit
     *
     * @return double
     */
    public function length(LengthUnit $unit)
    {
        if ($unit->getUnit() === LengthUnit::FOOT) {
            return $this->length * 3.28084;
        }

        return $this->length;
    }
}