<?php

namespace App\Model;

use App\Model\Model;


class LecturesList extends Model
{
    protected $table = 'lectureslist';

    public static function courseExists(string $course_id) {
        $data = "WHERE course_id = '$course_id'";

        return self::getAll('', $data);
    }
}
