<?php
namespace Symfony\Component\DependencyInjection\Loader\Configurator;
use App\App;
return function(ContainerConfigurator $configurator) {
    $configurator->parameters()
        ->set('youtube.key', array('key' => 'AIzaSyDvQTE5DVqpz9hLh6Y-rM_8T9DUrQf4wL0'))
        ->set('paysera.projectid',  146155)
        ->set('paysera.sign_password', 'ce28c97dcd8381b7d5a093ffd1deae38')
        ->set('paysera.accepturl', 'http://localhost'.App::INSTALL_FOLDER.'/order/answer')
        ->set('paysera.cancelurl', 'http://localhost'.App::INSTALL_FOLDER.'/order/cancelPaysera')
        ->set('paysera.callbackurl','http://localhost'.App::INSTALL_FOLDER.'/order/callbackpaysera')
        ->set('mailchimp.key', '0972ea13026619b2bed23ae1d69f4adc-us4')
        ->set('list.id', '820bdf2654')

    ;

    $services = $configurator->services();

    $services->set('youtube', 'Madcoda\Youtube')
        ->args(['%youtube.key%'])
    ;

    $services->set('paklausimas', 'Symfony\Component\HttpFoundation\Request')
        ->factory(['Symfony\Component\HttpFoundation\Request','createFromGlobals']);

    $services->set('paysera', 'App\Services\Paysera')
        ->args([[
            '%paysera.projectid%',
            '%paysera.sign_password%',
            '%paysera.accepturl%',
            '%paysera.cancelurl%',
            '%paysera.callbackurl%'
        ]]);
    $services->set('mailchimp', 'App\Services\MailChimp')
        ->args(['%mailchimp.key%','%list.id%'])
        // ->args([])
    ;

};