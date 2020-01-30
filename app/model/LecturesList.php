<?php

namespace App\Model;

use App\Model\Model;

class LecturesList extends Model
{
    protected $table = 'lectureslist';

    /**
     * @param string $course_id
     * @return array
     */
    public static function courseByIdExists(string $course_id) {
        return Model::rowsByValueExists('lectureslist', 'course_id', $course_id);
    }
}
