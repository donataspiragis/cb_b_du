<?php
namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;
use App\Model\Lecture;


//session_start();

class videoStatisticsController extends BaseController{
    public function show(){
        $API_key = 'AIzaSyD4rNOOOSNEZVG-BBDfexa4kdYl1dE1dgw';
        $lectures=Lecture::getAll();
        $videos=[];
        $max = sizeof($lectures);
        for($i = 0; $i < $max;$i++){
            $video_ID=str_replace('https://www.youtube.com/embed/','',$lectures[$i]->video_url);
            $videoRaw = file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=statistics&id='. $video_ID.'&key='.$API_key);
            $video=json_decode($videoRaw);
            $info=$video->items[0]->statistics;
            $videos[$i]['videos']= $lectures[$i]->video_url;
            $videos[$i]['likeCount']=$info->likeCount;
            $videos[$i]['dislikeCount']=$info->dislikeCount;
            $videos[$i]['commentCount']=$info->commentCount;
        }
        return $this->render('videoStatistic', ['videos' => $videos, 'value'=>'videostat','menu'=>'collapseOne']);
    }
}
