<?php

declare(strict_types=1);

namespace Playground\Sudoku;

class ZeroLocator
{
    public function __invoke(int $x, int $y): array
    {
        return [
            'x' => $this->foo($x),
            'y' => $this->foo($y),
        ];
    }

    private function foo(int $number): int
    {
        return ((int) ($number / 3)) * 3;
    }
}
