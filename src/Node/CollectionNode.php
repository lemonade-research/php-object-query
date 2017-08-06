<?php

namespace ObjectQuery\Node;

use ObjectQuery\NodeInterface;

/**
 * Class CollectionNode
 *
 * @package ObjectQuery\Node
 * @author Christian Blank <christian@cubicl.de>
 */
class CollectionNode implements NodeInterface
{
    /**
     * @var NodeInterface[]
     */
    private $collection;

    /**
     * CollectionNode constructor.
     *
     * @param NodeInterface[] $collection
     */
    public function __construct(array $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @return NodeInterface[]
     */
    public function getCollection(): array
    {
        return $this->collection;
    }
}