<?php

declare(strict_types=1);

namespace App\Tests;

use App\Domain\Model\CPUPlayer;
use App\Domain\Model\HumanPlayer;
use App\Domain\Model\PlayerInterface;
use App\Domain\Model\Table;
use PHPUnit\Framework\TestCase;

final class TableTest extends TestCase
{
    public function test_resolving_a_won_game_for_x_on_x_axis(): void
    {
        $table = new Table(3);

        $humanPlayer = new HumanPlayer();
        $humanPlayer->setTable($table);
        $humanPlayer->setSymbol('x');

        $cpuPlayer = new CPUPlayer();
        $cpuPlayer->setTable($table);
        $cpuPlayer->setSymbol('o');

        $table->addPlayer($humanPlayer);
        $table->addPlayer($cpuPlayer);

        $humanPlayer->move(0, 0);
        $cpuPlayer->move(0, 1);
        $humanPlayer->move(1, 0);
        $cpuPlayer->move(1, 1);
        $humanPlayer->move(2, 0);

        $this->assertSame(PlayerInterface::RESULT_DEFEAT, $cpuPlayer->getResult());
        $this->assertSame(PlayerInterface::RESULT_WIN, $humanPlayer->getResult());
    }

    public function test_resolving_a_won_game_for_x_on_x_axis_by_cpu(): void
    {
        $table = new Table(3);

        $humanPlayer = new HumanPlayer();
        $humanPlayer->setTable($table);
        $humanPlayer->setSymbol('x');

        $cpuPlayer = new CPUPlayer();
        $cpuPlayer->setTable($table);
        $cpuPlayer->setSymbol('o');

        $table->addPlayer($humanPlayer);
        $table->addPlayer($cpuPlayer);

        $humanPlayer->move(0, 2);
        $cpuPlayer->move(2, 1);
        $humanPlayer->move(2, 0);
        $cpuPlayer->move(1, 1);
        $humanPlayer->move(0, 0);
        $cpuPlayer->move(0, 1);

        $this->assertSame(PlayerInterface::RESULT_WIN, $cpuPlayer->getResult());
        $this->assertSame(PlayerInterface::RESULT_DEFEAT, $humanPlayer->getResult());
    }
}
