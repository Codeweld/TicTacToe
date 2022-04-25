<?php

declare(strict_types=1);

namespace App\Application\Provider;

interface SymbolProviderInterface
{
    public function provideOtherSymbol(string $excludedSymbol): string;
}
