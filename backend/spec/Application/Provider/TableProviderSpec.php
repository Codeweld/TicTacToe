<?php

declare(strict_types=1);

namespace spec\App\Application\Provider;

use App\Application\DTO\StartGame;
use App\Application\Factory\CPUPlayerFactoryInterface;
use App\Application\Factory\TableFactoryInterface;
use App\Application\Provider\SymbolProviderInterface;
use App\Application\Provider\TableProvider;
use App\Application\Provider\TableProviderInterface;
use App\Domain\Model\PlayerInterface;
use App\Domain\Model\TableInterface;
use PhpSpec\ObjectBehavior;

final class TableProviderSpec extends ObjectBehavior
{
    function let(
        TableFactoryInterface $tableFactory,
        CPUPlayerFactoryInterface $CPUPlayerFactory,
        SymbolProviderInterface $symbolProvider,
    ): void {
        $this->beConstructedWith(
            $tableFactory,
            $CPUPlayerFactory,
            $symbolProvider,
        );
    }

    function it_implements_interface(): void
    {
        $this->shouldImplement(TableProviderInterface::class);
    }

    function it_provides_table_for_cpu_random_game_mode(
        TableFactoryInterface $tableFactory,
        CPUPlayerFactoryInterface $CPUPlayerFactory,
        SymbolProviderInterface $symbolProvider,
        TableInterface $table,
        PlayerInterface $CPUPlayer,
    ): void {
        $startGameDTO = new StartGame(
            'x',
            TableProvider::GAME_MODE_CPU_RANDOM,
            '12345',
            3,
        );

        $tableFactory
            ->createWithSize(3)
            ->willReturn($table)
        ;

        $symbolProvider
            ->provideOtherSymbol('x')
            ->willReturn('o')
        ;

        $CPUPlayerFactory
            ->create()
            ->willReturn($CPUPlayer)
        ;
        $CPUPlayer
            ->setSymbol('o')
            ->shouldBeCalledOnce()
        ;
        $CPUPlayer
            ->setTable($table)
            ->shouldBeCalledOnce()
        ;

        $this
            ->provide($startGameDTO)
            ->shouldReturn($table)
        ;
    }

    function it_throws_exception_for_unsupported_game_mode(): void
    {
        $startGameDTO = new StartGame(
            'x',
            'invalid-game-mode',
            '12345',
            3,
        );

        $this
            ->shouldThrow(\InvalidArgumentException::class)
            ->during('provide', [$startGameDTO])
        ;
    }
}
