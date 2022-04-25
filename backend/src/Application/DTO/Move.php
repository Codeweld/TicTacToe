<?php

declare(strict_types=1);

namespace App\Application\DTO;

final class Move
{
    public function __construct(
        private int $x,
        private int $y,
        private string $connectionIdentifier,
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

    public function getConnectionIdentifier(): string
    {
        return $this->connectionIdentifier;
    }
}
