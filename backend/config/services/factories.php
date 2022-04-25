<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\Application\Factory\HumanPlayerFactory;
use App\Application\Factory\HumanPlayerFactoryInterface;

return function(ContainerConfigurator $configurator) {
    $services = $configurator
        ->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
        ->private()
    ;

    $services
        ->set(HumanPlayerFactory::class)
        ->alias(HumanPlayerFactoryInterface::class, HumanPlayerFactory::class)
    ;
};
