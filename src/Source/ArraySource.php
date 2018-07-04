<?php

namespace ObjectQuery\Source;

use ObjectQuery\SourceInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

/**
 * Class ArraySource
 *
 * @package ObjectQuery\Source
 * @author  Christian Blank <christian@cubicl.de>
 */
final class ArraySource implements SourceInterface
{
    /**
     * @var array
     */
    private $source;

    /**
     * @var PropertyAccessor
     */
    private $propertyAccessor;

    /**
     * @param array $source
     */
    public function __construct($source)
    {
        $this->source = $source;
        $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
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
        return array_map(
            function ($entry) use ($field) {
                $value = $this->propertyAccessor->getValue($entry, $field);

                if (is_scalar($value)) {
                    return $value;
                } elseif (is_object($value)) {
                    return new ObjectSource($value);
                } elseif (is_array($value)) {
                    return new ArraySource($value);
                }
            },
            $this->source
        );
    }
}
