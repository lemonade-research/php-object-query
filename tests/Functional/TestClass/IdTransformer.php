<?php

namespace ObjectQuery\Test\Functional\TestClass;

use ObjectQuery\TransformerInterface;

/**
 * Class IdTransformer
 *
 * @package ObjectQuery\Test\Functional\TestClass
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
