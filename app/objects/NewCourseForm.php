<?php

namespace App\Objects;

class NewCourseForm extends Form {

    public function __construct() {
//        var_dump(date('Y-m-d H:i'));
//        die();
        $month = rand(1, 12);
        $day = rand(1, 28);
        $hour = rand(0, 23);
        $minute = rand(0, 59);
        $course_name = 'Course ' . rand(1, 9);
        $course_description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
        $valid_to_date = rand(2021, 2025) . '-' . ($month < 10 ? '0' . $month : $month) . '-' . ($day < 10 ? '0' . $day : $day);
        $valid_to_time = ($hour < 10 ? '0' . $hour : $hour) . ':' . ($minute < 10 ? '0' . $minute : $minute);

        $form = [
            'fields' => [
                'course_name' => [
                    'type' => 'text',
                    'label' => 'Kurso pavadinimas',
                    'value' => $course_name,
                    'placeholder' => $course_name,
                    'required' => 1,
                    'classes' => [
                        'fieldset' => 'd-block mb-3',
                        'label' => 'd-block',
                        'input' => 'p-1'
                    ]
                ],
                'course_description' => [
                    'type' => 'textarea',
                    'label' => 'Aprašymas',
                    'value' => $course_description,
                    'placeholder' => 'Mr. Admin, describe this course hier!',
                    'required' => 1,
                    'classes' => [
                        'fieldset' => 'd-block mb-3',
                        'label' => 'd-block',
                        'input' => 'd-block p-1'
                    ]
                ],
                'cover_photo' => [
                    'type' => 'file',
                    'label' => 'Cover paveiksliukas',
                    'required' => 1,
                    'classes' => [
                        'fieldset' => 'd-block mb-3',
                        'label' => 'd-block'
                    ]
                ],
                'price' => [
                    'type' => 'number',
                    'label' => 'Kaina',
                    'value' => rand(10, 50),
                    'required' => 1,
                    'classes' => [
                        'fieldset' => 'd-inline-block mb-3',
                        'label' => 'd-block',
                        'input' => 'mr-2 p-1'
                    ]
                ],
                'disprice' => [
                    'type' => 'number',
                    'label' => 'Kaina su nuolaida',
                    'value' => rand(60, 100),
                    'required' => 1,
                    'classes' => [
                        'fieldset' => 'd-inline-block mb-3',
                        'label' => 'd-block',
                        'input' => 'mr-2 p-1'
                    ]
                ],
                'valid_to_date' => [
                    'type' => 'date',
                    'label' => 'Galioja iki (data)',
                    'value' => $valid_to_date,
                    'required' => 1,
                    'classes' => [
                        'fieldset' => 'd-inline-block mb-3',
                        'label' => 'd-block',
                        'input' => 'mr-2 p-1 border-0'
                    ]
                ],
                'valid_to_time' => [
                    'type' => 'time',
                    'label' => 'Galioja iki (laikas)',
                    'value' => $valid_to_time,
                    'required' => 1,
                    'classes' => [
                        'fieldset' => 'd-inline-block mb-3',
                        'label' => 'd-block',
                        'input' => 'w-100 p-1 border-0'
                    ]
                ],
                'is_active' => [
                    'type' => 'checkbox',
                    'value' => 'published',
                    'label' => 'Rodyti pagrindiniame puslapyje',
                    'required' => 1
                ]
            ],
            'buttons' => [
                'publish' => [
                    'label' => 'Skelbti',
                    'value' => 'publish',
                    'classes' => [
                        'fieldset' => 'p-4 d-inline-block'
                    ]
                ],
                'save' => [
                    'label' => 'Išsaugoti',
                    'value' => 'save',
                    'classes' => [
                        'fieldset' => 'p-4 d-inline-block'
                    ]
                ]
            ]
        ];

        parent::__construct($form);
    }
}