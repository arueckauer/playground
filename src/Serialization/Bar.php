<?php

declare(strict_types=1);

namespace Playground\Serialization;

class Bar
{
    private Baz $baz;

    public function __construct(Baz $baz)
    {
        $this->baz = $baz;
    }

    public function getBaz(): Baz
    {
        return $this->baz;
    }
}
