<?php

namespace Lemonade\ObjectQuery\Source;

use Lemonade\ObjectQuery\SourceInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

final class ObjectSource implements SourceInterface
{
    private PropertyAccessor $propertyAccessor;

    public function __construct(private readonly object $source)
    {
        $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
    }

    public function has(string $field): bool
    {
        return $this->propertyAccessor->isReadable($this->source, $field);
    }

    /**
     * @param string $field
     * @param mixed|null $default
     *
     * @return SourceInterface|mixed
     */
    public function get(string $field, mixed $default = null): mixed
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

        return null;
    }

    public function getSource(): object
    {
        return $this->source;
    }
}
