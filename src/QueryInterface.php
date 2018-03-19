<?php

namespace ObjectQuery;

/**
 * Interface QueryInterface
 * @package ObjectQuery
 * @author Christian Blank <christian@cubicl.de>
 */
interface QueryInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return DefinitionInterface
     */
    public function getDefinition(): DefinitionInterface;
}
