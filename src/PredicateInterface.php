<?php

namespace Lemonade\ObjectQuery;

interface PredicateInterface
{
    public function __invoke(object $object): bool;
}
