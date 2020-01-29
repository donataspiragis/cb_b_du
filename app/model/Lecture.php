<?php

namespace App\Model;

use App\Model\Model;
use DataBase\Connection;


class Lecture extends Model
{
    public static $videoTitle;
    public static $video;
    protected $table = 'lectures';

    public static function urlExists(string $url) {
        return Model::rowsByValueExists('lectures', 'video_url', $url);
    }
}
