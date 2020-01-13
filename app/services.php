<?php
namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return function(ContainerConfigurator $configurator) {
    $configurator->parameters()
        ->set('youtube.key', array('key' => 'AIzaSyDvQTE5DVqpz9hLh6Y-rM_8T9DUrQf4wL0'))
    ;

    $services = $configurator->services();

    $services->set('youtube', 'Madcoda\Youtube')
        ->args(['%youtube.key%'])
    ;

};

