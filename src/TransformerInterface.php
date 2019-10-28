<?php

namespace Cubicl\ObjectQuery;

/**
 * Interface TransformerInterface
 *
 * @package Cubicl\ObjectQuery
 * @author  Christian Blank <christian@cubicl.de>
 */
interface TransformerInterface
{
    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function transform($value);
}
