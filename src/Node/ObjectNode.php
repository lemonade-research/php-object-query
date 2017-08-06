<?php

namespace ObjectQuery\Node;

use ObjectQuery\NodeInterface;

/**
 * Class ObjectNode
 *
 * @package ObjectQuery\Node
 * @author Christian Blank <christian@cubicl.de>
 */
class ObjectNode implements NodeInterface
{
    /**
     * @var Object
     */
    private $object;

    /**
     * ObjectNode constructor.
     *
     * @param Object $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }

    /**
     * @return Object
     */
    public function getObject(): Object
    {
        return $this->object;
    }


}