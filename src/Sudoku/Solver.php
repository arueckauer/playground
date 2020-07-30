<?php

declare(strict_types=1);

namespace Playground\Sudoku;

use Laminas\Validator\ValidatorInterface;
use Playground\Sudoku\Exception\InvalidGridException;

use function implode;
use function range;

use const PHP_EOL;

class Solver
{
    private array $grid;

    private ValidatorInterface $validator;

    private ZeroLocator $zeroLocator;

    public function __construct(
        array $grid,
        ValidatorInterface $validator,
        ZeroLocator $zeroLocator
    ) {
        $this->grid        = $grid;
        $this->validator   = $validator;
        $this->zeroLocator = $zeroLocator;

        if (! $this->validator->isValid($grid)) {
            throw InvalidGridException::create();
        }
    }

    public function __invoke(): bool
    {
        foreach (range(0, 8) as $y) {
            foreach (range(0, 8) as $x) {
                if ($this->grid[$y][$x] !== ' ') {
                    continue;
                }

                foreach (range(1, 9) as $number) {
                    if ($this->isNumberPossibleForCell($number, $x, $y)) {
                        $this->grid[$y][$x] = $number;

                        if (true === $this()) {
                            return true;
                        }
                        $this->grid[$y][$x] = ' ';
                    }
                }
                    return false;
            }
        }

        return true;
    }

    public function __toString(): string
    {
        $output = '';
        foreach ($this->grid as $row) {
            $output .= implode(' ', $row) . PHP_EOL;
        }
        return $output . PHP_EOL;
    }

    public function isNumberPossibleForCell(int $number, int $x, int $y): bool
    {
        return true === $this->isNumberPossibleForRow($number, $y)
        && true === $this->isNumberPossibleForColumn($number, $x)
        && true === $this->isNumberPossibleForBlock($number, $x, $y);
    }

    public function isNumberPossibleForRow(int $number, int $y): bool
    {
        foreach ($this->grid[$y] as $value) {
            if ($value === $number) {
                return false;
            }
        }

        return true;
    }

    public function isNumberPossibleForColumn(int $number, int $x): bool
    {
        foreach (range(0, 8) as $row) {
            if ($this->grid[$row][$x] === $number) {
                return false;
            }
        }

        return true;
    }

    public function isNumberPossibleForBlock(int $number, int $x, int $y): bool
    {
        ['x' => $x0, 'y' => $y0] = ($this->zeroLocator)($x, $y);

        foreach (range(0, 2) as $xOffset) {
            foreach (range(0, 2) as $yOffset) {
                if ($this->grid[$y0 + $yOffset][$x0 + $xOffset] === $number) {
                    return false;
                }
            }
        }

        return true;
    }

    public function getGrid(): array
    {
        return $this->grid;
    }
}
