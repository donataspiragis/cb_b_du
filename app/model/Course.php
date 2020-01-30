<?php

namespace App\Model;

use App\Model\Model;


class Course extends Model {
    protected $table = 'courses';

    /**
     * @param string $course_name
     * @return array
     */
    public static function courseNameExists(string $course_name): array {
        return Model::rowsByValueExists('courses', 'name', $course_name);
    }
}
