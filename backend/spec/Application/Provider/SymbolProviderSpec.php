<?php

declare(strict_types=1);

namespace spec\App\Application\Provider;

use App\Application\Provider\SymbolProviderInterface;
use PhpSpec\ObjectBehavior;

final class SymbolProviderSpec extends ObjectBehavior
{
    function it_implements_interface(): void
    {
        $this->shouldImplement(SymbolProviderInterface::class);
    }

    function it_provides_x_symbol_if_o_symbol_is_taken(): void
    {
        $this
            ->provideOtherSymbol('o')
            ->shouldReturn('x')
        ;
    }

    function it_provides_o_symbol_if_x_symbol_is_taken(): void
    {
        $this
            ->provideOtherSymbol('x')
            ->shouldReturn('o')
        ;
    }
}
