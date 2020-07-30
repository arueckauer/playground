<?php

declare(strict_types=1);

namespace Playground\Serialization;

class Baz
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
