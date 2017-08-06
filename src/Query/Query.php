<?php

namespace ObjectQuery\Query;

use ObjectQuery\QueryInterface;

/**
 * Class Query
 *
 * @package ObjectQuery
 * @author Christian Blank <christian@cubicl.de>
 */
class Query implements QueryInterface
{
    /**
     * @var array
     */
    private $properties;

    /**
     * Query constructor.
     *
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        $this->properties = $properties;
    }

    /**
     * @return array
     */
    public function getProperties(): array
    {
        return $this->properties;
    }
}