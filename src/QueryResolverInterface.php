<?php

namespace Cubicl\ObjectQuery;

/**
 * Interface QueryResolverInterface
 * @package Cubicl\ObjectQuery
 * @author Christian Blank <christian@cubicl.de>
 */
interface QueryResolverInterface
{
    public function resolve(SourceInterface $source): array;
}
