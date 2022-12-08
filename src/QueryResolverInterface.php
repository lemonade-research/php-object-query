<?php

namespace Lemonade\ObjectQuery;

interface QueryResolverInterface
{
    /**
     * @return array<string, mixed>
     */
    public function resolve(SourceInterface $source): array;
}
