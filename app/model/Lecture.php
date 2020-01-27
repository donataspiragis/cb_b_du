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
        $data = "WHERE video_url = '$url'";

        return self::getAll('', $data);
    }
}
