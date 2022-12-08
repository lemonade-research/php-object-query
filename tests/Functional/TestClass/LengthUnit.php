<?php

namespace Lemonade\ObjectQuery\Tests\Functional\TestClass;

class LengthUnit
{
    public const METER = 1;

    public const FOOT = 2;

    /**
     * @var int
     */
    private $unit;

    /**
     * LengthUnit constructor.
     *
     * @param int $unit
     */
    public function __construct($unit)
    {
        $this->unit = $unit;
    }

    /**
     * @return int
     */
    public function getUnit()
    {
        return $this->unit;
    }
}
