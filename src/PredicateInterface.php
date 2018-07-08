<?php

namespace ObjectQuery;

/**
 * Interface PredicateInterface
 *
 * @package ObjectQuery
 * @author  Christian Blank <christian@cubicl.de>
 */
interface PredicateInterface
{
    public function __invoke($object): bool;
}
