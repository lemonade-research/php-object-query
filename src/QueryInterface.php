<?php

namespace ObjectQuery;

/**
 * Interface QueryInterface
 * @package ObjectQuery
 * @author Christian Blank <christian@cubicl.de>
 */
interface QueryInterface
{
    /**
     * @return array
     */
    public function getProperties(): array;
}