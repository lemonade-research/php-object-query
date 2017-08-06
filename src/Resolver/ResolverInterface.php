<?php

namespace ObjectQuery\Resolver;

use ObjectQuery\NodeInterface;

/**
 * Interface ResolverInterface
 *
 * @package ObjectQuery\Resolver
 * @author Christian Blank <christian@cubicl.de>
 */
interface ResolverInterface
{
    /**
     * @param NodeInterface $graph
     * @param string $name
     *
     * @return NodeInterface
     */
    public function getProperty(NodeInterface $graph, string $name): NodeInterface;

    /**
     * @param string $name
     *
     * @return NodeInterface
     */
    public function getRoot(string $name): NodeInterface;
}