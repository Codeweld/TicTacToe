<?php

declare(strict_types=1);

namespace App\Application\Iterator;

use App\Domain\Model\PlayerInterface;
use App\Domain\Model\TableInterface;

final class TableIterator implements \Iterator
{
    private array $tables = [];

    private int $position = 0;

    private int $tablesCount = 0;

    public function current(): TableInterface
    {
        return $this->tables[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return array_key_exists($this->position, $this->tables);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function add(TableInterface $table): void
    {
        $this->tables = array_merge($this->tables, [$table]);

        ++$this->tablesCount;
    }

//    public function remove(TableInterface $table): void
//    {
//        foreach ($this->tables as $key => $element) {
//            if ($element->resourceId === $table->resourceId) {
//                unset($this->tables[$key]);
//
//                --$this->tablesCount;
//
//                break;
//            }
//        }
//    }
//

    public function getTableByPlayerConnectionIdentifier(
        string $connectionIdentifier,
    ): ?TableInterface {
        /** @var TableInterface $table */
        foreach ($this->tables as $table) {
            /** @var PlayerInterface $player */
            foreach ($table->getPlayers() as $player) {
                if ($player->getConnectionIdentifier() !== $connectionIdentifier) {
                    continue;
                }

                return $table;
            }
        }

        return null;
    }

    public function count(): int
    {
        return $this->tablesCount;
    }
}
