<?php

declare(strict_types=1);

namespace App\Application\Provider;

final class ClassnameProvider implements ClassnameProviderInterface
{
    public static function provide(object $object): string
    {
        return self::provideFromFQCN($object::class);
    }

    public static function provideFromFQCN(string $fullyQualifiedClassName): string
    {
        return substr(
            $fullyQualifiedClassName,
            strrpos($fullyQualifiedClassName, '\\') + 1,
        );
    }
}
