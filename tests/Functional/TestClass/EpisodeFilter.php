<?php

namespace ObjectQuery\Test\Functional\TestClass;

use ObjectQuery\PredicateInterface;

/**
 * Class IdFilter
 *
 * @package ObjectQuery\Test\Functional\TestClass
 * @author  Christian Blank <christian@cubicl.de>
 */
class EpisodeFilter implements PredicateInterface
{
    /**
     * @var int
     */
    private $threshold;

    /**
     * IdFilter constructor.
     *
     * @param int $threshold
     */
    public function __construct(int $threshold)
    {
        $this->threshold = $threshold;
    }

    /**
     * @param Episode $object
     *
     * @return bool
     */
    public function __invoke($object): bool
    {
        return $object->getEpisode() <= $this->threshold;
    }
}
