<?php

namespace Cubicl\ObjectQuery\Tests\Functional\TestClass;

/**
 * Class LengthUnit
 *
 * @package Cubicl\ObjectQuery\Tests\Functional\TestClass
 * @author Christian Blank <christian@cubicl.de>
 */
class LengthUnit
{
    const METER = 1;

    const FOOT = 2;

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
