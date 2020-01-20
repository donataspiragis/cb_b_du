<?php

namespace App\View;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

class View
{
    public function render($templateName, array $parameters = array())
    {
        $templateName = !empty($templateName) ? $templateName : 'error404';
        $twig = new Environment(new FilesystemLoader('../src/views'), array('autoescape' => false, 'debug' => true));
        $twig->addExtension(new DebugExtension());
        return $twig->render($templateName.'.php', $parameters);
    }
    public function error($templateName, array $parameters = array())
    {
        $twig = new Environment(new FilesystemLoader('../src/views'), array('autoescape' => false));
        echo $twig->render('error404.php', $parameters);
    }
}
