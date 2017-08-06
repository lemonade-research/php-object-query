<?php

namespace ObjectQuery\Test\Functional\TestClass;

/**
 * Class Episode
 *
 * @package ObjectQuery\Test\Functional\TestClass
 * @author Christian Blank <christian@cubicl.de>
 */
class Episode
{
    const NEW_HOPE = 1;

    const EMPIRE = 2;

    const JEDI = 3;

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