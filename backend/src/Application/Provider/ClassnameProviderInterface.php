<?php

declare(strict_types=1);

namespace App\Application\Provider;

interface ClassnameProviderInterface
{
    public static function provide(object $object): string;

    public static function provideFromFQCN(string $fullyQualifiedClassName): string;
}
