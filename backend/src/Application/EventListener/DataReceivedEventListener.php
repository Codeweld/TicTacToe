<?php

declare(strict_types=1);

namespace App\Application\EventListener;

use App\Application\DTO\Move;
use App\Application\DTO\StartGame;
use App\Application\Event\DataReceivedEvent;
use App\Application\Handler\GameHandlerInterface;
use App\Application\Provider\ClassnameProvider;

final class DataReceivedEventListener
{
    public function __construct(
        private GameHandlerInterface $gameHandler,
    ) {
    }

    public function onDataReceived(DataReceivedEvent $dataReceivedEvent): void
    {
        $data = $dataReceivedEvent->getData();
        $connectionIdentifier = $dataReceivedEvent->getConnectionIdentifier();

        $decodedMessage = json_decode($data);

        $startGameClassname = ClassnameProvider::provideFromFQCN(
            StartGame::class,
        );
        $moveClassname = ClassnameProvider::provideFromFQCN(
            Move::class,
        );

        $dto = match ($decodedMessage->command) {
            $startGameClassname => new StartGame(
                $decodedMessage->symbol,
                $decodedMessage->mode,
                $connectionIdentifier,
                $decodedMessage->tableSize,
            ),
            $moveClassname => new Move(
                $decodedMessage->x,
                $decodedMessage->y,
                $connectionIdentifier,
            ),
        };

        if ($dto instanceof StartGame) {
            $this->gameHandler->handleGameStart($dto);
        }

        if ($dto instanceof Move) {
            $this->gameHandler->handleMove($dto);
        }
    }
}
