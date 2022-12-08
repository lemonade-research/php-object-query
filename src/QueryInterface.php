<?php

namespace Lemonade\ObjectQuery;

interface QueryInterface
{
    public function getName(): string;

    public function getDefinition(): DefinitionInterface;
}
