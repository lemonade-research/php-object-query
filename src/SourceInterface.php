<?php

namespace Lemonade\ObjectQuery;

interface SourceInterface
{
    public function has(string $field): bool;

    /**
     * @param string $field
     * @param mixed|null $default
     *
     * @return SourceInterface|mixed
     */
    public function get(string $field, mixed $default = null): mixed;

    /**
     * @return array<mixed>|object
     */
    public function getSource(): array|object;
}
