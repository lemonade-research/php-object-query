<?php

namespace Cubicl\ObjectQuery;

/**
 * Interface DefinitionInterface
 *
 * @package Cubicl\ObjectQuery
 * @author  Christian Blank <christian@cubicl.de>
 */
interface DefinitionInterface
{
    /**
     * @param SourceInterface $source
     *
     * @return mixed
     */
    public function getValue(SourceInterface $source);
}
