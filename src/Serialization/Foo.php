<?php

declare(strict_types=1);

namespace Playground\Serialization;

class Foo
{
    private Bar $bar;

    public function __construct(Bar $bar)
    {
        $this->bar = $bar;
    }

    public function getBar(): Bar
    {
        return $this->bar;
    }
}
