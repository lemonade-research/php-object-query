<?php

namespace ObjectQuery;

/**
 * Interface QueryResolverInterface
 * @package ObjectQuery
 * @author Christian Blank <christian@cubicl.de>
 */
interface QueryResolverInterface
{
    public function resolve(SourceInterface $source): array;
}
