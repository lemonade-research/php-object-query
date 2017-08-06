<?php


namespace ObjectQuery\Resolver;

/**
 * Interface ResolverInterface
 *
 * @package ObjectQuery\Resolver
 * @author Christian Blank <christian@cubicl.de>
 */
interface ResolverInterface
{
    public function getProperty($graph, $name);

    public function getRoot($name);
}