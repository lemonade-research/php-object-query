<?php

namespace ObjectQuery\Source;

use ObjectQuery\SourceInterface;
use ReflectionClass;

/**
 * Class ObjectSource
 *
 * @package ObjectQuery\Source
 * @author  Christian Blank <christian@cubicl.de>
 */
final class ObjectSource implements SourceInterface
{
    /**
     * @var object
     */
    private $source;

    /**
     * @param object $source
     */
    public function __construct($source)
    {
        if (!is_object($source)) {
            throw new \InvalidArgumentException('Source must be an object');
        }
        $this->source = $source;
    }

    /**
     * @param string $field
     *
     * @return bool
     * @throws \ReflectionException
     */
    public function has(string $field): bool
    {
        $x = new ReflectionClass($this->source);

        return $x->hasProperty($field);
    }

    /**
     * @param string $field
     * @param mixed  $default
     *
     * @return SourceInterface|mixed
     * @throws \ReflectionException
     */
    public function get(string $field, $default = null)
    {
        if (!$this->has($field)) {
            return $default;
        }

        $x = new ReflectionClass($this->source);
        $property = $x->getProperty($field);
        $property->setAccessible(true);

        $value = $property->getValue($this->source);

        if (is_scalar($value)) {
            return $value;
        } elseif (is_object($value)) {
            return new ObjectSource($value);
        } elseif (is_array($value)) {
            return new ArraySource($value);
        }
    }
}
