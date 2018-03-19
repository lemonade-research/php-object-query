<?php

namespace ObjectQuery;

/**
 * Interface DefinitionInterface
 *
 * @package ObjectQuery
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
