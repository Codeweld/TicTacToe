<?php

declare(strict_types=1);

namespace App\Application\Provider;

final class SymbolProvider implements SymbolProviderInterface
{
    private const ALL_AVAILABLE_SYMBOLS = ['x', 'o'];

    public function provideOtherSymbol(string $excludedSymbol): string
    {
        $availableSymbols = array_diff(
            self::ALL_AVAILABLE_SYMBOLS,
            [$excludedSymbol],
        );

        $randomKey = array_rand($availableSymbols);

        return $availableSymbols[$randomKey];
    }
}
