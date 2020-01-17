<?php
namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use App\Model\Model;

class LectureController extends BaseController  {

    public function index($id){
//        return $this->render('forms/videosAdd',['video' => $id]);
    }

    //this one should be service
   public function getVideos(){
       $videoList=$this-> makeVideosList();
       return $videoList;
   }

    private function makeVideosList(){
        $channelId = 'UCeTVoczn9NOZA9blls3YgUg';
        $maxResults = 3;
        $API_key = 'AIzaSyC2bzQLTHYtXj7R1TSvlZ-1HyY_OxB1xnI';
//        $API_key = 'AIzaSyD4rNOOOSNEZVG-BBDfexa4kdYl1dE1dgw';
        $listOfVideoKey= $this->getVideosKeyFromChanel($channelId, $maxResults, $API_key);
        $max = sizeof( $listOfVideoKey);
        for($i = 0; $i < $max; $i++) {
            $videoList[]='https://www.youtube.com/embed/'.$listOfVideoKey[$i];
        }
        return  $videoList;
    }
    private function  getVideosKeyFromChanel($channelId, $maxResults, $API_key){
        $video_list = file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$channelId.'&maxResults='.$maxResults.'&key='.$API_key.'');
        preg_match_all  ('/("videoId": ")(.+?(?="))/',  $video_list, $matches);
        $videosKeyList=$matches[2];
        return  $videosKeyList;
    }
    public function test(){
        $youtube = App::$containerBuilder->get('youtube');
        $channelId = 'UCeTVoczn9NOZA9blls3YgUg';
        $videoList = $youtube->searchChannelVideos('', '$channelId', 5);
        echo '<pre>';
        var_dump($videoList);
    }


}

