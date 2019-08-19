<?php

namespace ObjectQuery\Source;

use ObjectQuery\SourceInterface;
use ReflectionClass;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

/**
 * Class ObjectSource
 *
 * @package ObjectQuery\Source
 * @author  Christian Blank <christian@cubicl.de>
 */
final class ObjectSource implements SourceInterface
{
    /** @var object */
    private $source;

    /** @var PropertyAccessor */
    private $propertyAccessor;

    public function __construct($source)
    {
        if (!is_object($source)) {
            throw new \InvalidArgumentException('Source must be an object');
        }
        $this->source = $source;
        $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
    }

    public function has(string $field): bool
    {
        return $this->propertyAccessor->isReadable($this->source, $field);
    }

    /**
     * @param string $field
     * @param mixed  $default
     *
     * @return SourceInterface|mixed
     */
    public function get(string $field, $default = null)
    {
        if (!$this->has($field)) {
            return $default;
        }

        $value = $this->propertyAccessor->getValue($this->source, $field);

        if (is_scalar($value)) {
            return $value;
        }

        if (is_object($value)) {
            return new ObjectSource($value);
        }

        if (is_array($value)) {
            return new ArraySource($value);
        }
    }

    public function getSource()
    {
        return $this->source;
    }
}
