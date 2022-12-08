<?php

namespace Lemonade\ObjectQuery;

interface TransformerInterface
{
    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function transform(mixed $value): mixed;
}
