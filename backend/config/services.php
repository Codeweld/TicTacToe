<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return function(ContainerConfigurator $configurator) {
    $services = $configurator
        ->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
        ->private()
    ;

    $services
        ->load('App\\', '../src/*')
        ->exclude('../src/{Entity,Migrations,Tests,Kernel.php}')
    ;

    $configurator->import('services/**/*');
};
