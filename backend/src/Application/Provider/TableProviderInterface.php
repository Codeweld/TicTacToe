<?php

declare(strict_types=1);

namespace App\Application\Provider;

use App\Application\DTO\StartGame;
use App\Domain\Model\TableInterface;

interface TableProviderInterface
{
    public function provide(StartGame $startGameDTO): TableInterface;
}
