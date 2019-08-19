<?php

namespace Cubicl\ObjectQuery\Tests\Functional\TestClass;

/**
 * Class Review
 *
 * @package Cubicl\ObjectQuery\Tests\Functional\TestClass
 * @author Christian Blank <christian@cubicl.de>
 */
class Review
{
    /**
     * @var int
     */
    private $stars;

    /**
     * @var string
     */
    private $commentary;

    /**
     * Review constructor.
     *
     * @param int $stars
     * @param string $commentary
     */
    public function __construct($stars, $commentary)
    {
        $this->stars = $stars;
        $this->commentary = $commentary;
    }


    /**
     * @return int
     */
    public function stars()
    {
        return $this->stars;
    }

    /**
     * @return string
     */
    public function commentary()
    {
        return $this->commentary;
    }
}
