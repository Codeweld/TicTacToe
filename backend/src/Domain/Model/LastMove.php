<?php

declare(strict_types=1);

namespace App\Domain\Model;

final class LastMove
{
    public function __construct(
        private int $x,
        private int $y,
        private string $symbol,
    ) {
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }
}
