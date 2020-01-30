<?php
namespace App;
use App\Controller\UserController;

class Route {

    /**
     * @param Array ROUTE
     * @return routes for controllers
     */
    const ROUTE = [
        '' => ['FrontPageController', 'index'],
        'front@showall' => ['FrontPageController', 'showall'],
        'order@statistics' => ['OrderController', 'statistics'],
        'order@payload' => ['OrderController', 'payload'],
        'order@d_payload' => ['OrderController', 'd_payload'],
        'order@payexisting' => ['OrderController', 'payexisting'],
        'order@checkPrePayment' => ['OrderController', 'checkPrePayment'],
        'order@paid' => ['OrderController', 'paid'],
        'order@answer' => ['OrderController', 'answer'],
        'order@cancelPaysera' => ['OrderController', 'cancelPaysera'],
        'order@callbackpaysera' => ['OrderController', 'callbackpaysera'],
        'info@collect' => ['StudentsInfoController','collectinfo'],
        'user@register'=>['UserController','register'],
        'user@registerNew'=>['UserController','registerNew'],
        'user@login'=>['UserController','login'],
        'user@logout'=>['UserController','logout'],
        'user@changePassword'=>['UserController','changePassword'],
        'user@passwordStore'=>['UserController','passwordStore'],
        'user@passwordReminder'=>['UserController','passwordReminder'],
        'user@passwordForget'=>['UserController','passwordReminderChangePassword'],

//        'buy@index' => ['BuyallController', 'index'],
//        'course@index' => ['CourseController', 'index'],
        'course@create' => ['CourseController', 'create'],
        'course@edit' => ['CourseController', 'edit'],
        'course@store' => ['CourseController', 'store'],
        'course@update' => ['CourseController', 'update'],
//        'invoice@index' => ['InvoiceController', 'index'],
'course@display' => ['CourseController', 'display'],
        'lecture@index' => ['LectureController', 'index'],
'lecture@show' => ['LectureController', 'show'],
//        'offer@index' => ['OfferController', 'index'],
//        'order@index' => ['OrderController', 'index'],
//        'auth@index' => ['AuthentificationController', 'index'],
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
        }
        else if ($url[0] =='order' && isset($url[1])) {
            if(substr($url[1], 0, strpos($url[1], '?')) == 'answer'){

                $url_l = substr($url[1], 0, strpos($url[1], '?'));
                $url_key = $url[0] . '@' . $url_l;

            }
            else {
                $url_key = $url[0] . '@' . $url[1];
            }
        }

        else if (isset($url[0]) && isset($url[1])) {
            $url_key = $url[0] . '@' . $url[1];

        } else if (isset($url[0])){
            $url_key = '';
        }
        else {

            return ['BaseController', 'error'];
        }


        ;
        return isset(self::ROUTE[$url_key]) ? self::ROUTE[$url_key] : ['BaseController', 'error'];;
    }

    public static function getpayment($url){
        if ($url[0] =='order' && isset($url[1])) {
            if (substr($url[1], 0, strpos($url[1], '?')) == 'answer') {
                $atst = strpos($url[1], '?') + 11;
                $data = substr($url[1], $atst);


                $url_l = substr($url[1], 0, strpos($url[1], '?'));
                $url_key = $url[0] . '@' . $url_l;
                $urlll = ['data' => $data];
                return $urlll;
            }
        }
        return '';

    }


}
