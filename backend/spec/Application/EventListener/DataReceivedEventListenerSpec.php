<?php

declare(strict_types=1);

namespace spec\App\Application\EventListener;

use App\Application\DTO\Move;
use App\Application\DTO\StartGame;
use App\Application\Event\DataReceivedEvent;
use App\Application\Handler\GameHandlerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

final class DataReceivedEventListenerSpec extends ObjectBehavior
{
    function let(GameHandlerInterface $gameHandler): void
    {
        $this->beConstructedWith($gameHandler);
    }

    function it_listens_to_data_received_event_and_reacts_to_start_game_action(
        GameHandlerInterface $gameHandler,
    ): void {
        $dataReceivedEvent = new DataReceivedEvent(
            '{"command":"StartGame","symbol":"x","mode":"cpu-random","tableSize":3}',
            '12345',
        );

        $gameHandler
            ->handleGameStart(Argument::type(StartGame::class))
            ->shouldBeCalledOnce()
        ;

        $this->onDataReceived($dataReceivedEvent);
    }

    function it_listens_to_data_received_event_and_reacts_to_move_action(
        GameHandlerInterface $gameHandler,
    ): void {
        $dataReceivedEvent = new DataReceivedEvent(
            '{"command":"Move","x":1,"y":2}',
            '12345',
        );

        $gameHandler
            ->handleMove(Argument::type(Move::class))
            ->shouldBeCalledOnce()
        ;

        $this->onDataReceived($dataReceivedEvent);
    }
}
