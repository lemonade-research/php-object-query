<?php

namespace ObjectQuery\Source;

use ObjectQuery\SourceInterface;
use ReflectionClass;

/**
 * Class ArraySource
 *
 * @package ObjectQuery\Source
 * @author  Christian Blank <christian@cubicl.de>
 */
final class ArraySource implements SourceInterface
{
    /**
     * @var array|\ArrayAccess
     */
    private $source;

    /**
     * @param array|\ArrayAccess $source
     */
    public function __construct($source)
    {
        if (!is_array($source) && !$source instanceof \ArrayAccess) {
            throw new \InvalidArgumentException('Source must be an array or implement ArrayAccess interface');
        }
        $this->source = $source;
    }

    /**
     * @param string $field
     *
     * @return bool
     */
    public function has(string $field): bool
    {
        return true;
    }

    /**
     * @param string $field
     * @param mixed  $default
     *
     * @return array
     */
    public function get(string $field, $default = null)
    {
        return array_map(function($entry) use ($field) {
            $x = new ReflectionClass($entry);
            $property = $x->getProperty($field);
            $property->setAccessible(true);

            $value = $property->getValue($entry);

            if (is_scalar($value)) {
                return $value;
            } elseif (is_object($value)) {
                return new ObjectSource($value);
            } elseif (is_array($value)) {
                return new ArraySource($value);
            }
        }, $this->source);
    }
}
