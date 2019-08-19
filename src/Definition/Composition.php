<?php

namespace Cubicl\ObjectQuery\Definition;

use Cubicl\ObjectQuery\DefinitionInterface;
use Cubicl\ObjectQuery\SourceInterface;

/**
 * Class Composition
 *
 * @package Cubicl\ObjectQuery\Definition
 * @author  Christian Blank <christian@cubicl.de>
 */
final class Composition implements DefinitionInterface
{
    /** @var callable */
    private $compositor;

    public function __construct(callable $compositor)
    {
        $this->compositor = $compositor;
    }

    /**
     * @param SourceInterface $source
     *
     * @return mixed
     */
    public function getValue(SourceInterface $source)
    {
        return call_user_func($this->compositor, $source);
    }
}
