<?php

declare(strict_types=1);

namespace ColdDegree;

class BracketSequence
{
    private const BRACKETS_MAP = [
        '(' => ')',
        '[' => ']',
        '{' => '}',
    ];

    private string $brackets;

    public function __construct(string $brackets)
    {
        $validChars = [...\array_keys(self::BRACKETS_MAP), ...\array_values(self::BRACKETS_MAP)];

        $isValidInput = \array_reduce(
            \str_split($brackets),
            static fn (bool $acc, string $ch) => $acc && \in_array($ch, $validChars, true),
            true,
        );

        if (!$isValidInput) {
            throw new \InvalidArgumentException('$brackets must contain characters from BRACKETS_MAP only');
        }

        $this->brackets = $brackets;
    }

    public function isValid(): bool
    {
        return true;
    }
}
