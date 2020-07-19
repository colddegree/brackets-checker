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

    /**
     * @var string[]
     */
    private array $brackets;

    public function __construct(string $brackets)
    {
        $chars = \str_split($brackets);
        $validChars = [...$this->openingBrackets(), ...$this->closingBrackets()];

        $isValidInput = \array_reduce(
            $chars,
            static fn (bool $acc, string $ch) => $acc && \in_array($ch, $validChars, true),
            true,
        );

        if (!$isValidInput) {
            throw new \InvalidArgumentException('$brackets must contain characters from BRACKETS_MAP only');
        }

        $this->brackets = $chars;
    }

    public function isValid(): bool
    {
        $stack = new \SplStack();
        foreach ($this->brackets as $bracket) {
            if (\in_array($bracket, $this->openingBrackets(), true)) {
                $stack->push($bracket);
            } elseif (\in_array($bracket, $this->closingBrackets(), true)) {
                if ($stack->isEmpty()) {
                    return false; // встретили закрывающуюся скобку и стек пуст — последовательность некорректна
                }
                if ($this->matches($stack->top(), $bracket)) { // в стеке всегда лежат открывающиеся скобки
                    $stack->pop();
                } else {
                    return false;
                }
            } else {
                throw new \RuntimeException();
            }
        }
        return $stack->isEmpty();
    }

    private function matches(string $openBracket, string $closingBracket): bool
    {
        return self::BRACKETS_MAP[$openBracket] === $closingBracket;
    }

    /**
     * @return string[]
     */
    private function openingBrackets(): array
    {
        return \array_keys(self::BRACKETS_MAP);
    }

    /**
     * @return string[]
     */
    private function closingBrackets(): array
    {
        return \array_values(self::BRACKETS_MAP);
    }
}
