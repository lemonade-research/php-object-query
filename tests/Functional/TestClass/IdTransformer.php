<?php

namespace Cubicl\ObjectQuery\Tests\Functional\TestClass;

use Cubicl\ObjectQuery\TransformerInterface;

/**
 * Class IdTransformer
 *
 * @package Cubicl\ObjectQuery\Tests\Functional\TestClass
 * @author  Christian Blank <christian@cubicl.de>
 */
class IdTransformer implements TransformerInterface
{
    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function transform($value)
    {
        return $value + 1;
    }
}
