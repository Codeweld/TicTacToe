<?php

declare(strict_types=1);

namespace App\Domain\Model;

final class HumanPlayer implements PlayerInterface
{
    private TableInterface $table;

    private ?string $result = null;

    public function __construct(
        private ?string $symbol = null,
        private ?string $connectionIdentifier = null,
    ) {
    }

    public function getConnectionIdentifier(): ?string
    {
        return $this->connectionIdentifier;
    }

    public function setConnectionIdentifier(
        string $connectionIdentifier,
    ): void {
        $this->connectionIdentifier = $connectionIdentifier;
    }

    public function getTable(): TableInterface
    {
        return $this->table;
    }

    public function setTable(TableInterface $table): void
    {
        $this->table = $table;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(?string $symbol): void
    {
        $this->symbol = $symbol;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setResult(string $result): void
    {
        $this->result = $result;
    }

    public function assignWin(): void
    {
        $this->result = self::RESULT_WIN;
    }

    public function assignDefeat(): void
    {
        $this->result = self::RESULT_DEFEAT;
    }

    public function assignDraw(): void
    {
        $this->result = self::RESULT_DRAW;
    }

    public function move(int $x, int $y): void
    {
        $table = $this->getTable();

        $table->setField(
            $x,
            $y,
            $this->getSymbol(),
        );
    }
}
