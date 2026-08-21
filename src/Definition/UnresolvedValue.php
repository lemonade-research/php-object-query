<?php

namespace Lemonade\ObjectQuery\Definition;

/**
 * Marker returned by an optional Path when its value could not be resolved.
 * The QueryResolver recognizes this sentinel and omits the corresponding
 * key from the result set entirely, instead of setting it to null.
 */
final class UnresolvedValue
{
    private static ?self $instance = null;

    private function __construct()
    {
    }

    public static function instance(): self
    {
        return self::$instance ??= new self();
    }
}
