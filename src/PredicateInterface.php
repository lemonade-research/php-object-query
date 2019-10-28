<?php

namespace Cubicl\ObjectQuery;

/**
 * Interface PredicateInterface
 *
 * @package Cubicl\ObjectQuery
 * @author  Christian Blank <christian@cubicl.de>
 */
interface PredicateInterface
{
    public function __invoke($object): bool;
}
