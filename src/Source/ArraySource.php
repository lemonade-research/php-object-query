<?php

namespace ObjectQuery\Source;

use ObjectQuery\SourceInterface;

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
        if (is_array($this->source)) {
            return array_key_exists($field, $this->source);
        }

        return $this->source->offsetExists($field);
    }

    /**
     * @param string $field
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get(string $field, $default = null)
    {
        if (!$this->has($field)) {
            return $default;
        }

        return $this->source[$field];
    }
}
