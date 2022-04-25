<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\Application\Factory\CPUPlayerFactory;
use App\Application\Provider\TableProvider;

return function(ContainerConfigurator $configurator) {
    $services = $configurator
        ->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
        ->private()
    ;

    $services
        ->set(TableProvider::class)
        ->arg('$CPUPlayerFactory', service(CPUPlayerFactory::class))
    ;
};
