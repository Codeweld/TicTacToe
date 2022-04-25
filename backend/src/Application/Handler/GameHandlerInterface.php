<?php

declare(strict_types=1);

namespace App\Application\Handler;

use App\Application\DTO\Move;
use App\Application\DTO\StartGame;

interface GameHandlerInterface
{
    public function handleGameStart(StartGame $startGameDTO): void;

    public function handleMove(Move $moveDTO): void;
}
