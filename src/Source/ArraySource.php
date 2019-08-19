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
    /** @var array */
    private $source;

    /** @var PropertyAccessor */
    private $propertyAccessor;

    public function __construct(array $source)
    {
        $this->source = $source;
        $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
    }

    public function has(string $field): bool
    {
        return true;
    }

    public function get(string $field, $default = null): array
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
            },
            $this->source
        );
    }

    /**
     * @return array
     */
    public function getSource(): array
    {
        return $this->source;
    }
}
