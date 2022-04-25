<?php

declare(strict_types=1);

namespace spec\App\Application\Resolver;

use App\Application\DTO\CPUMove;
use App\Application\Resolver\CPUPlayerMoveResolverInterface;
use App\Domain\Model\PlayerInterface;
use App\Domain\Model\TableInterface;
use PhpSpec\ObjectBehavior;

final class RandomCPUPlayerMoveResolverSpec extends ObjectBehavior
{
    function it_implements_interface(): void
    {
        $this->shouldImplement(CPUPlayerMoveResolverInterface::class);
    }

    function it_resolves_random_cpu_move(
        PlayerInterface $CPUPlayer,
        TableInterface $table,
    ): void {
        $CPUPlayer->getTable()->willReturn($table);
        $table->getSize()->willReturn(3);
        $table
            ->getFields()
            ->willReturn([
                ['', 'x', 'o'],
                ['o', 'x', 'x'],
                ['x', 'o', 'x'],
            ])
        ;

        $this
            ->resolve($CPUPlayer)
            ->shouldBeLike(new CPUMove(0, 0))
        ;
    }

    function it_throws_exception_if_cpu_player_cannot_make_any_move(
        PlayerInterface $CPUPlayer,
        TableInterface $table,
    ): void {
        $CPUPlayer->getTable()->willReturn($table);
        $table->getSize()->willReturn(3);
        $table
            ->getFields()
            ->willReturn([
                ['o', 'x', 'o'],
                ['o', 'x', 'x'],
                ['x', 'o', 'x'],
            ])
        ;

        $this
            ->shouldThrow(\RuntimeException::class)
            ->during('resolve', [$CPUPlayer])
        ;
    }
}
