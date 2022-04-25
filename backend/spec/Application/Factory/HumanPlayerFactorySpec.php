<?php

declare(strict_types=1);

namespace spec\App\Application\Factory;

use App\Application\Factory\HumanPlayerFactoryInterface;
use App\Domain\Model\HumanPlayer;
use PhpSpec\ObjectBehavior;

final class HumanPlayerFactorySpec extends ObjectBehavior
{
    function it_implements_interface(): void
    {
        $this->shouldImplement(HumanPlayerFactoryInterface::class);
    }

    function it_creates_human_player_with_symbol_and_connection_identifier(): void
    {
        $humanPlayer = new HumanPlayer(
            'x',
            '12345',
        );

        $this
            ->createWithSymbolAndConnectionIdentifier(
                'x',
                '12345',
            )
            ->shouldBeLike($humanPlayer)
        ;
    }
}
