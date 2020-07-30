<?php

declare(strict_types=1);

namespace Playground\Sudoku\Validator;

use Laminas\Validator\Regex;
use Laminas\Validator\ValidatorInterface;

use function count;
use function is_array;
use function print_r;
use function sprintf;

class Grid implements ValidatorInterface
{
    private array $messages = [];

    /**
     * @param mixed $value
     */
    public function isValid($value): bool
    {
        $this->resetMessages();

        if (! is_array($value)) {
            $this->addMessage(sprintf('Given $value is not of type array'));
            return false;
        }

        $numberOfRows = count($value);
        if (9 !== $numberOfRows) {
            $this->addMessage(sprintf('Array must have 9 rows, but has %s', $numberOfRows));
        }

        $regex = new Regex('$[1-9\s]$');
        foreach ($value as $rowNumber => $row) {
            $numberOfColumns = count($row);
            if (9 !== $numberOfColumns) {
                $this->addMessage(sprintf('A row must have 9 rows, but row %s has %s', $rowNumber, $numberOfColumns));
            }

            foreach ($row as $columnNumber => $cell) {
                if (! $regex->isValid($cell)) {
                    $this->addMessage(sprintf(
                        'Invalid value (%s) given for cell [%s|%s]',
                        print_r($cell, true),
                        $rowNumber,
                        $columnNumber
                    ));
                }
            }
        }

        return 0 === count($this->messages);
    }

    public function getMessages(): array
    {
        return $this->messages;
    }

    private function resetMessages(): void
    {
        $this->messages = [];
    }

    private function addMessage(string $message): void
    {
        $this->messages[] = $message;
    }
}
