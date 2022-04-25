<?php

declare(strict_types=1);

namespace App\Application\Notifier;

use App\Application\Event\GameEnded;
use App\Application\Event\TableStateChanged;
use App\Domain\Model\CPUPlayer;
use App\Domain\Model\TableInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class PlayersNotifier implements PlayersNotifierInterface
{
    public function __construct(
        private EventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function propagateTableState(TableInterface $table): void
    {
        $players = $table->getPlayers();

        foreach ($players as $player) {
            if ($player instanceof CPUPlayer) {
                continue;
            }

            $tableStateChanged = TableStateChanged::createForPlayer(
                $player,
            );

            $this->eventDispatcher->dispatch($tableStateChanged);
        }
    }

    public function propagateEndGame(TableInterface $table): void
    {
        $players = $table->getPlayers();

        foreach ($players as $player) {
            if ($player instanceof CPUPlayer) {
                continue;
            }

            $gameEnded = GameEnded::createForPlayer(
                $player,
            );

            $this->eventDispatcher->dispatch($gameEnded);
        }
    }
}
