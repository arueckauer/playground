<?php

declare(strict_types=1);

namespace PlaygroundTest\Sudoku;

use PHPUnit\Framework\TestCase;
use Playground\Sudoku\ZeroLocator;

class ZeroLocatorTest extends TestCase
{
    public static function data(): array
    {
        return [
            [0, 0, ['x' => 0, 'y' => 0]],
            [4, 2, ['x' => 3, 'y' => 0]],
            [6, 1, ['x' => 6, 'y' => 0]],
            [2, 5, ['x' => 0, 'y' => 3]],
            [3, 3, ['x' => 3, 'y' => 3]],
            [7, 4, ['x' => 6, 'y' => 3]],
            [1, 8, ['x' => 0, 'y' => 6]],
            [5, 7, ['x' => 3, 'y' => 6]],
            [8, 6, ['x' => 6, 'y' => 6]],
        ];
    }

    /**
     * @dataProvider data
     * @covers \Playground\Sudoku\ZeroLocator
     */
    public function testInvoke(int $x, int $y, array $expected): void
    {
        $zeroLocator = new ZeroLocator();
        self::assertEquals($expected, $zeroLocator($x, $y));
    }
}
