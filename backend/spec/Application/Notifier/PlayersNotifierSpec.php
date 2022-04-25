<?php

declare(strict_types=1);

namespace spec\App\Application\Notifier;

use App\Application\Event\GameEnded;
use App\Application\Event\TableStateChanged;
use App\Domain\Model\CPUPlayer;
use App\Domain\Model\HumanPlayer;
use App\Domain\Model\PlayerInterface;
use App\Domain\Model\TableInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class PlayersNotifierSpec extends ObjectBehavior
{
    function let(EventDispatcherInterface $eventDispatcher): void
    {
        $this->beConstructedWith($eventDispatcher);
    }

    function it_propagates_table_state_for_human_player(
        EventDispatcherInterface $eventDispatcher,
        TableInterface $table,
    ): void {
        $humanPlayer = new HumanPlayer();
        $CPUPlayer = new CPUPlayer();

        $humanPlayer->setTable($table->getWrappedObject());
        $humanPlayer->setConnectionIdentifier('12345');
        $CPUPlayer->setTable($table->getWrappedObject());

        $table
            ->getPlayers()
            ->willReturn([
                $humanPlayer,
                $CPUPlayer,
            ])
        ;
        $table->getFields()->willReturn([]);

        $eventDispatcher
            ->dispatch(
                Argument::type(TableStateChanged::class)
            )
            ->shouldBeCalledOnce()
        ;

        $this->propagateTableState($table);
    }

    function it_propagates_end_game_for_human_player(
        EventDispatcherInterface $eventDispatcher,
        TableInterface $table,
    ): void {
        $humanPlayer = new HumanPlayer();
        $CPUPlayer = new CPUPlayer();

        $humanPlayer->setTable($table->getWrappedObject());
        $humanPlayer->setResult(PlayerInterface::RESULT_WIN);
        $humanPlayer->setConnectionIdentifier('12345');
        $CPUPlayer->setTable($table->getWrappedObject());

        $table
            ->getPlayers()
            ->willReturn([
                $humanPlayer,
                $CPUPlayer,
            ])
        ;

        $eventDispatcher
            ->dispatch(
                Argument::type(GameEnded::class)
            )
            ->shouldBeCalledOnce()
        ;

        $this->propagateEndGame($table);
    }
}
