<?php

namespace Cubicl\ObjectQuery;

/**
 * Interface QueryInterface
 * @package Cubicl\ObjectQuery
 * @author Christian Blank <christian@cubicl.de>
 */
interface QueryInterface
{
    public function getName(): string;

    public function getDefinition(): DefinitionInterface;
}
