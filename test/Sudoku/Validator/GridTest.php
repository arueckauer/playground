<?php

declare(strict_types=1);

namespace PlaygroundTest\Sudoku\Validator;

use PHPUnit\Framework\TestCase;
use Playground\Sudoku\Validator\Grid;

class GridTest extends TestCase
{
    private Grid $gridValidator;

    protected function setUp(): void
    {
        $this->gridValidator = new Grid();
    }

    public static function nonArrayTypes(): array
    {
        return [
            [null],
            [''],
            [0],
            [0.1],
        ];
    }

    /**
     * @dataProvider nonArrayTypes
     * @covers \Playground\Sudoku\Validator\Grid
     */
    public function testIsValidReturnsFalseOnNonArrayType($nonArrayType): void
    {
        self::assertFalse($this->gridValidator->isValid($nonArrayType));
    }

    /**
     * @covers \Playground\Sudoku\Validator\Grid
     */
    public function testIsValidReturnsTrueForArrayWithEmptyValues(): void
    {
        $array = [
            [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
            [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
            [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
            [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
            [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
            [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
            [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
            [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
            [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
        ];

        self::assertTrue($this->gridValidator->isValid($array));
    }

    /**
     * @covers \Playground\Sudoku\Validator\Grid
     */
    public function testIsValidReturnsTrueForArrayOfOnes(): void
    {
        $array = [
            [1, 1, 1, 1, 1, 1, 1, 1, 1],
            [1, 1, 1, 1, 1, 1, 1, 1, 1],
            [1, 1, 1, 1, 1, 1, 1, 1, 1],
            [1, 1, 1, 1, 1, 1, 1, 1, 1],
            [1, 1, 1, 1, 1, 1, 1, 1, 1],
            [1, 1, 1, 1, 1, 1, 1, 1, 1],
            [1, 1, 1, 1, 1, 1, 1, 1, 1],
            [1, 1, 1, 1, 1, 1, 1, 1, 1],
            [1, 1, 1, 1, 1, 1, 1, 1, 1],
        ];

        self::assertTrue($this->gridValidator->isValid($array));
        self::assertCount(0, $this->gridValidator->getMessages());
    }

    /**
     * @covers \Playground\Sudoku\Validator\Grid
     */
    public function testIsValidReturnsTrueForArrayOfValidMixedValues(): void
    {
        $array = [
            [' ', 2, 3, 4, 5, 6, 7, 8, 9],
            [1, ' ', 3, 4, 5, 6, 7, 8, 9],
            [1, 2, ' ', 4, 5, 6, 7, 8, 9],
            [1, 2, 3, ' ', 5, 6, 7, 8, 9],
            [1, 2, 3, 4, ' ', 6, 7, 8, 9],
            [1, 2, 3, 4, 5, ' ', 7, 8, 9],
            [1, 2, 3, 4, 5, 6, ' ', 8, 9],
            [1, 2, 3, 4, 5, 6, 7, ' ', 9],
            [1, 2, 3, 4, 5, 6, 7, 8, ' '],
        ];

        self::assertTrue($this->gridValidator->isValid($array));
        self::assertCount(0, $this->gridValidator->getMessages());
    }
}
