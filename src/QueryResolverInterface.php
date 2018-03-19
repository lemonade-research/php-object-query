<?php

namespace ObjectQuery;

/**
 * Interface QueryResolverInterface
 * @package ObjectQuery
 * @author Christian Blank <christian@cubicl.de>
 */
interface QueryResolverInterface
{
    /**
     *
     * @param array|object $context
     *
     * @return array
     */
    public function resolveArray($context): array;
}
