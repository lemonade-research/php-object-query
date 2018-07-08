<?php

namespace ObjectQuery;

/**
 * Interface TransformerInterface
 *
 * @package ObjectQuery
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
