<?php

namespace Lemonade\ObjectQuery\Tests\Functional\TestClass;

use Lemonade\ObjectQuery\PredicateInterface;

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
    public function __invoke(object $object): bool
    {
        return $object->getEpisode() <= $this->threshold;
    }
}
