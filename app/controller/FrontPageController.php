<?php
namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

class FrontPageController extends BaseController  {
    public function index(){
        $youtube = App::$containerBuilder->get('youtube');
        $video = $youtube->getVideoInfo('uzQQMi2WYFA');
        $video2 = $youtube->getVideoInfo('TkEMzxxnKUQ');

        return $this->render('index', ['vid' => $video, 'vid2' => $video2]);
    }


}

