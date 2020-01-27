<?php
namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return function(ContainerConfigurator $configurator) {
    $configurator->parameters()
        ->set('youtube.key', array('key' => 'AIzaSyDvQTE5DVqpz9hLh6Y-rM_8T9DUrQf4wL0'))
        ->set('paysera.projectid',  146155)
        ->set('paysera.sign_password', 'ce28c97dcd8381b7d5a093ffd1deae38')
        ->set('paysera.accepturl', 'http://localhost/cb_b_du/public/')
        ->set('paysera.cancelurl', 'http://localhost/cb_b_du/public/')
        ->set('paysera.callbackurl', 'http://localhost/cb_b_du/public/')
    ;

    $services = $configurator->services();

    $services->set('youtube', 'Madcoda\Youtube')
        ->args(['%youtube.key%'])
    ;

    $services->set('paklausimas', 'Symfony\Component\HttpFoundation\Request')
        ->factory(['Symfony\Component\HttpFoundation\Request','createFromGlobals']);

    $services->set('paysera', 'App\Services\Paysera')
        ->args([
            '%paysera.projectid%',
            '%paysera.sign_password%',
            '%paysera.accepturl%',
            '%paysera.cancelurl%',
            '%paysera.callbackurl%'
        ]);

};

