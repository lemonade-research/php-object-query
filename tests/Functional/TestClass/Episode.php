<?php

namespace Cubicl\ObjectQuery\Tests\Functional\TestClass;

/**
 * Class Episode
 *
 * @package Cubicl\ObjectQuery\Tests\Functional\TestClass
 * @author Christian Blank <christian@cubicl.de>
 */
class Episode
{
    public const NEW_HOPE = 1;

    public const EMPIRE = 2;

    public const JEDI = 3;

    /**
     * @var int
     */
    private $episode;

    /**
     * Episode constructor.
     *
     * @param int $episode
     */
    public function __construct($episode)
    {
        $this->episode = $episode;
    }

    /**
     * @return int
     */
    public function getEpisode(): int
    {
        return $this->episode;
    }
}
