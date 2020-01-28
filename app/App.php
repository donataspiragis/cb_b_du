<?php
namespace App;
include('../config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
class App {
    const INSTALL_FOLDER = root;
    private static $request_url;
    private static $controller;
    private static $config;
    public static $containerBuilder;
    /**
     * @param Function call to start app
     * @return returns app with predifined starting elements
     */
    public static function start(){
        self::$request_url = str_replace(self::INSTALL_FOLDER, '', $_SERVER['REQUEST_URI']);
        self::$request_url = ltrim( self::$request_url, '/');
        self::$request_url = rtrim( self::$request_url, '/');
        self::$request_url = explode('/', self::$request_url);
        self::$config = require __DIR__ . '/../config.php';
        self::$containerBuilder = new ContainerBuilder();
        $loader = new PhpFileLoader(self::$containerBuilder, new FileLocator(__DIR__));
        $loader->load('services.php');

        $controller = Route::getController(self::$request_url);
        $payment = Route::getpayment(self::$request_url);
        $g = 'App\\Controller\\'.$controller[0];

        if(empty($payment) ){
            self::$controller = new $g;
            self::$controller->{$controller[1]}(self::$request_url[2] ?? '');
        } else {
            self::$controller = new $g;
            self::$controller->{$controller[1]}($payment);
        }

    }
    public static function get($service = null){
        if($service === null){
            return self::$containerBuilder;
        }
        try{
            $a = self::$containerBuilder->get($service);
        }
        catch(ServiceNotFoundException $e){
            $response = new Response();
            $response->prepare(self::$containerBuilder->get('paklausimas'));
            $response->setStatusCode(418);
            $response->send();
            echo"whate";
            die('dds');
        }
        return $a;
    }
}
