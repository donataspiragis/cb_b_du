<?php
namespace App;
class Route {

    /**
     * @param Array ROUTE
     * @return routes for controllers
     */
    const ROUTE = [
        '' => ['FrontPageController', 'index'],

    ];

    /**
     * @param Array $url
     * @return url key
     */
    public static function getController($url){
        if ($url[0] =='examples' && isset($url[1]) ) { //  tikrina ar "examples" turi 3 parametra ir ar jis yra skaicius(../examples/index/1), jeigu ne, grazina 404 error page;
            if (isset($url[2]) && is_numeric($url[2]) ) {
                $url_key = $url[0] . '@' . $url[1];
            }  else {
                return ['BaseController', 'error'];
            }
        } else if ($url[0] =='topic' && isset($url[1]) ) { //  tikrina ar "topic" turi 3 parametra ir ar jis yra skaicius(../examples/index/1), jeigu ne, grazina 404 error page;
            if (isset($url[2]) && is_numeric($url[2]) ) {
                $url_key = $url[0] . '@' . $url[1];
            }  else {
                return ['BaseController', 'error'];
            }
        } else if ($url[0] =='nav' && isset($url[2]) || $url[0] == 'statistics' && isset($url[2])) {
            return ['BaseController', 'error'];
        } else if (isset($url[0]) && isset($url[1])) {
            $url_key = $url[0] . '@' . $url[1];
        } else if (isset($url[0])){
            $url_key = '';
        } else {
            return ['BaseController', 'error'];
        };
        return isset(self::ROUTE[$url_key]) ? self::ROUTE[$url_key] : ['BaseController', 'error'];;
    }
}
