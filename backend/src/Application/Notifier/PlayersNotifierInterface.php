<?php

declare(strict_types=1);

namespace App\Application\Notifier;

use App\Domain\Model\TableInterface;

interface PlayersNotifierInterface
{
    public function propagateTableState(TableInterface $table): void;

    public function propagateEndGame(TableInterface $table): void;
}
