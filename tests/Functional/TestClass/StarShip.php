<?php

namespace Lemonade\ObjectQuery\Tests\Functional\TestClass;

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
     * @param float $length
     */
    public function __construct($id, $name, $length)
    {
        $this->id = $id;
        $this->name = $name;
        $this->length = $length;
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
