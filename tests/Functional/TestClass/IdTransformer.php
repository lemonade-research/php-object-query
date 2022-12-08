<?php

namespace Lemonade\ObjectQuery\Tests\Functional\TestClass;

use Lemonade\ObjectQuery\TransformerInterface;

class IdTransformer implements TransformerInterface
{
    public function transform(mixed $value): mixed
    {
        return $value + 1;
    }
}
