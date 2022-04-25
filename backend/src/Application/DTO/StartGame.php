<?php

declare(strict_types=1);

namespace App\Application\DTO;

final class StartGame
{
    public function __construct(
        private string $symbol,
        private string $mode,
        private string $connectionIdentifier,
        private int $tableSize = 3,
    ) {
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getMode(): string
    {
        return $this->mode;
    }

    public function getConnectionIdentifier(): string
    {
        return $this->connectionIdentifier;
    }

    public function getTableSize(): int
    {
        return $this->tableSize;
    }
}
