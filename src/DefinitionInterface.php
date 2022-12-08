<?php

namespace Lemonade\ObjectQuery;

interface DefinitionInterface
{
    public function getValue(SourceInterface $source): mixed;
}
