<?php

namespace Lemonade\ObjectQuery\Source;

use Lemonade\ObjectQuery\SourceInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

final class ArraySource implements SourceInterface
{
    private PropertyAccessor $propertyAccessor;

    /**
     * @param array<mixed> $source
     */
    public function __construct(private readonly array $source)
    {
        $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
    }

    public function has(string $field): bool
    {
        return array_key_exists($field, $this->source);
    }

    /**
     * @return array<SourceInterface|mixed>
     */
    public function get(string $field, mixed $default = null): array
    {
        return array_map(
            function ($entry) use ($field) {
                $value = $this->propertyAccessor->getValue($entry, $field);

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
            },
            $this->source
        );
    }

    /**
     * @return array<mixed>
     */
    public function getSource(): array
    {
        return $this->source;
    }
}
