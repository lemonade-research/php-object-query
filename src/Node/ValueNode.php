<?php

namespace ObjectQuery\Node;

use ObjectQuery\NodeInterface;

/**
 * Class ValueNode
 *
 * @package ObjectQuery\Node
 * @author Christian Blank <christian@cubicl.de>
 */
class ValueNode implements NodeInterface
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * ValueNode constructor.
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}