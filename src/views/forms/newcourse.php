<?php

class NewCourseForm {
    protected $form = [];

    public function construct__() {
        $this->setForm();
    }

    public function setForm() {
        $form = [
            'fields' => [
                [
                    'name' => 'course_name',
                    'type' => 'text',
                    'value' => 'Example course',
                    'placeholder' => 'example text'
                ],
            'buttons' => [

            ]
        ];
    }
}