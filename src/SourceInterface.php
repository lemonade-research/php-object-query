<?php

namespace Cubicl\ObjectQuery;

/**
 * Interface SourceInterface
 *
 * @package Cubicl\ObjectQuery
 * @author  Christian Blank <christian@cubicl.de>
 */
interface SourceInterface
{
    public function has(string $field): bool;

    /**
     * @param string $field
     * @param mixed  $default
     *
     * @return SourceInterface|mixed
     */
    public function get(string $field, $default = null);

    public function getSource();
}
