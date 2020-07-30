<?php

declare(strict_types=1);

namespace Playground\Sudoku\Exception;

use InvalidArgumentException;

class InvalidGridException extends InvalidArgumentException
{
    public static function create(): self
    {
        return new self('Provided Grid is invalid');
    }
}
