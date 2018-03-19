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
     * @return mixed
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

        return $property->getValue($this->source);
    }
}
