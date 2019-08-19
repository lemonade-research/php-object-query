<?php

namespace ObjectQuery\Definition;

use ObjectQuery\DefinitionInterface;
use ObjectQuery\SourceInterface;

/**
 * Class Value
 *
 * @package ObjectQuery\Definition
 * @author  Christian Blank <christian@cubicl.de>
 */
final class Value implements DefinitionInterface
{
    /** @var mixed */
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue(SourceInterface $source)
    {
        return $this->value;
    }
}
