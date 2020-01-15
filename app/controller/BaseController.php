<?php
namespace App\Controller;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use DataBase\Connection;
use Carbon\Carbon;

class BaseController{
    protected $db;
    public static $carb;

    public function __construct()
    {
        $this->db = new Connection();
    }

    public function render($templateName, array $parameters = array())
    {
        $templateName = !empty($templateName) ? $templateName : 'error404';
        $twig = new Environment(new FilesystemLoader('../src/views'), array('autoescape' => false, 'debug' => true));
        $twig->addExtension(new DebugExtension());
        echo $twig->render($templateName.'.php', $parameters);
    }
    public function error($templateName, array $parameters = array())
    {
        $twig = new Environment(new FilesystemLoader('../src/views'), array('autoescape' => false));
        echo $twig->render('error404.php', $parameters);
    }
}



