<?php

declare(strict_types=1);

namespace PlaygroundTest\Sudoku;

use PHPUnit\Framework\TestCase;
use Playground\Sudoku\Exception\InvalidGridException;
use Playground\Sudoku\Solver;
use Playground\Sudoku\Validator\Grid;
use Playground\Sudoku\ZeroLocator;

class SolverTest extends TestCase
{
    /**
     * @covers \Playground\Sudoku\Solver
     */
    public function testInvokeThrowsExceptionForInvalidGrid(): void
    {
        $grid = [
            ['a', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
            [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
            [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
            [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
            [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
            [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
            [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
            [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
            [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
        ];

        $this->expectException(InvalidGridException::class);
        new Solver($grid, new Grid(), new ZeroLocator());
    }

    /**
     * @covers \Playground\Sudoku\Solver
     */
    public function testInvokeSolvesSimpleGrid(): void
    {
        $grid     = [
            [' ', 3, 4, 6, 7, 8, 9, 1, 2],
            [6, ' ', 2, 1, 9, 5, 3, 4, 8],
            [1, 9, ' ', 3, 4, 2, 5, 6, 7],
            [8, 5, 9, ' ', 6, 1, 4, 2, 3],
            [4, 2, 6, 8, ' ', 3, 7, 9, 1],
            [7, 1, 3, 9, 2, ' ', 8, 5, 6],
            [9, 6, 1, 5, 3, 7, ' ', 8, 4],
            [2, 8, 7, 4, 1, 9, 6, ' ', 5],
            [3, 4, 5, 2, 8, 6, 1, 7, ' '],
        ];
        $expected = [
            [5, 3, 4, 6, 7, 8, 9, 1, 2],
            [6, 7, 2, 1, 9, 5, 3, 4, 8],
            [1, 9, 8, 3, 4, 2, 5, 6, 7],
            [8, 5, 9, 7, 6, 1, 4, 2, 3],
            [4, 2, 6, 8, 5, 3, 7, 9, 1],
            [7, 1, 3, 9, 2, 4, 8, 5, 6],
            [9, 6, 1, 5, 3, 7, 2, 8, 4],
            [2, 8, 7, 4, 1, 9, 6, 3, 5],
            [3, 4, 5, 2, 8, 6, 1, 7, 9],
        ];

        $solver = new Solver($grid, new Grid(), new ZeroLocator());
        $solver();
        self::assertEquals($expected, $solver->getGrid());
    }

    /**
     * @covers \Playground\Sudoku\Solver
     */
    public function testInvokeSolvesMediumGrid(): void
    {
        $grid     = [
            [' ', 3, 4, 6, ' ', 8, 9, 1, 2],
            [6, 7, ' ', 1, 9, 5, ' ', 4, 8],
            [1, ' ', 8, 3, 4, ' ', 5, 6, 7],
            [8, ' ', 9, 7, 6, ' ', 4, 2, 3],
            [4, 2, ' ', 8, 5, 3, ' ', 9, 1],
            [' ', 1, 3, 9, ' ', 4, 8, 5, ' '],
            [9, 6, 1, ' ', 3, 7, 2, ' ', 4],
            [2, 8, 7, 4, 1, 9, 6, 3, 5],
            [3, 4, ' ', 2, ' ', 6, 1, 7, 9],
        ];
        $expected = [
            [5, 3, 4, 6, 7, 8, 9, 1, 2],
            [6, 7, 2, 1, 9, 5, 3, 4, 8],
            [1, 9, 8, 3, 4, 2, 5, 6, 7],
            [8, 5, 9, 7, 6, 1, 4, 2, 3],
            [4, 2, 6, 8, 5, 3, 7, 9, 1],
            [7, 1, 3, 9, 2, 4, 8, 5, 6],
            [9, 6, 1, 5, 3, 7, 2, 8, 4],
            [2, 8, 7, 4, 1, 9, 6, 3, 5],
            [3, 4, 5, 2, 8, 6, 1, 7, 9],
        ];

        $solver = new Solver($grid, new Grid(), new ZeroLocator());
        $solver();
        self::assertEquals($expected, $solver->getGrid());
    }

    /**
     * @covers \Playground\Sudoku\Solver
     */
    public function testInvokeSolvesDifficultGrid(): void
    {
        $grid     = [
            [' ', ' ', ' ', ' ', ' ', ' ', 1, ' ', 3],
            [9, ' ', ' ', 4, ' ', ' ', ' ', 5, 6],
            [5, ' ', ' ', 6, 2, ' ', ' ', ' ', ' '],
            [' ', 4, 1, 5, ' ', ' ', ' ', ' ', ' '],
            [' ', 8, ' ', ' ', ' ', 4, 6, 7, 5],
            [' ', ' ', ' ', 7, 8, 3, ' ', 1, ' '],
            [' ', ' ', ' ', ' ', ' ', ' ', 5, 2, 9],
            [' ', 6, 7, ' ', ' ', ' ', 4, ' ', ' '],
            [' ', ' ', 5, 3, 4, 8, ' ', ' ', 1],
        ];
        $expected = [
            [4, 2, 6, 8, 7, 5, 1, 9, 3],
            [9, 7, 8, 4, 3, 1, 2, 5, 6],
            [5, 1, 3, 6, 2, 9, 8, 4, 7],
            [7, 4, 1, 5, 9, 6, 3, 8, 2],
            [3, 8, 9, 2, 1, 4, 6, 7, 5],
            [6, 5, 2, 7, 8, 3, 9, 1, 4],
            [8, 3, 4, 1, 6, 7, 5, 2, 9],
            [1, 6, 7, 9, 5, 2, 4, 3, 8],
            [2, 9, 5, 3, 4, 8, 7, 6, 1],
        ];

        $solver = new Solver($grid, new Grid(), new ZeroLocator());
        $solver();
        self::assertEquals($expected, $solver->getGrid());
    }

    /**
     * @covers \Playground\Sudoku\Solver
     */
    public function testInvokeSolvesEvilGrid(): void
    {
        $grid     = [
            [' ', ' ', 7, ' ', ' ', 1, ' ', ' ', 5],
            [' ', 8, ' ', ' ', 9, ' ', ' ', 1, ' '],
            [2, ' ', ' ', 4, ' ', ' ', 9, ' ', ' '],
            [7, ' ', ' ', 2, ' ', ' ', 3, ' ', ' '],
            [' ', 9, ' ', ' ', 8, ' ', ' ', 4, ' '],
            [' ', ' ', 4, ' ', ' ', 7, ' ', ' ', 1],
            [' ', ' ', 5, ' ', ' ', 6, ' ', ' ', 9],
            [' ', 7, ' ', ' ', 2, ' ', ' ', 5, ' '],
            [6, ' ', ' ', 3, ' ', ' ', 8, ' ', ' '],
        ];
        $expected = [
            [9, 4, 7, 8, 3, 1, 2, 6, 5],
            [5, 8, 3, 6, 9, 2, 4, 1, 7],
            [2, 6, 1, 4, 7, 5, 9, 3, 8],
            [7, 5, 8, 2, 1, 4, 3, 9, 6],
            [1, 9, 6, 5, 8, 3, 7, 4, 2],
            [3, 2, 4, 9, 6, 7, 5, 8, 1],
            [8, 3, 5, 7, 4, 6, 1, 2, 9],
            [4, 7, 9, 1, 2, 8, 6, 5, 3],
            [6, 1, 2, 3, 5, 9, 8, 7, 4],
        ];

        $solver = new Solver($grid, new Grid(), new ZeroLocator());
        $solver();
        self::assertEquals($expected, $solver->getGrid());
    }

    /**
     * @covers \Playground\Sudoku\Solver
     */
    public function testInvokeSolvesExcruciatingGrid(): void
    {
        $grid     = [
            [' ', 4, ' ', ' ', 7, ' ', ' ', 3, ' '],
            [9, ' ', ' ', ' ', ' ', 1, ' ', ' ', 5],
            [' ', ' ', 1, ' ', 6, ' ', 7, ' ', ' '],
            [' ', 6, ' ', ' ', ' ', ' ', ' ', ' ', ' '],
            [3, ' ', 5, ' ', 1, ' ', 2, ' ', 9],
            [' ', ' ', ' ', ' ', ' ', ' ', ' ', 5, ' '],
            [' ', ' ', 3, ' ', 5, ' ', 6, ' ', ' '],
            [5, ' ', ' ', 2, ' ', ' ', ' ', ' ', 8],
            [' ', 8, ' ', ' ', 9, ' ', ' ', 4, ' '],
        ];
        $expected = [
            [6, 4, 8, 9, 7, 5, 1, 3, 2],
            [9, 3, 7, 4, 2, 1, 8, 6, 5],
            [2, 5, 1, 3, 6, 8, 7, 9, 4],
            [8, 6, 9, 5, 3, 2, 4, 1, 7],
            [3, 7, 5, 6, 1, 4, 2, 8, 9],
            [1, 2, 4, 7, 8, 9, 3, 5, 6],
            [4, 9, 3, 8, 5, 7, 6, 2, 1],
            [5, 1, 6, 2, 4, 3, 9, 7, 8],
            [7, 8, 2, 1, 9, 6, 5, 4, 3],
        ];

        $solver = new Solver($grid, new Grid(), new ZeroLocator());
        $solver();
        self::assertEquals($expected, $solver->getGrid());
    }
}
