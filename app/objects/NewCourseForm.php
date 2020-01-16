<?php

namespace App\Objects;

class NewCourseForm extends Form {

    public $form_data = [
        'fields' => [
            [
                'label' => 'Kurso pavadinimas',
                'name' => 'course_name',
                'id' => 'course_name',
                'classes' => [
                    'fieldset' => 'd-block mb-3',
                    'label' => 'd-block'
                ],
                'type' => 'text',
                'value' => 'Example course',
                'placeholder' => 'example text'
            ],
            [
                'label' => 'Aprašymas',
                'name' => 'course_description',
                'id' => 'course_description',
                'classes' => [
                    'fieldset' => 'd-block mb-3',
                    'label' => 'd-block'
                ],
                'type' => 'textarea',
                'value' => 'Example description',
                'placeholder' => 'describe this course'
            ],
            [
                'label' => 'Cover paveiksliukas',
                'name' => 'course_name',
                'id' => 'course_name',
                'classes' => [
                    'fieldset' => 'd-block mb-3',
                    'label' => 'd-block'
                ],
                'type' => 'file'
            ],
            [
                'label' => 'Kaina',
                'name' => 'price',
                'id' => 'price',
                'classes' => [
                    'fieldset' => 'd-inline-block mb-3',
                    'label' => 'd-block'
                ],
                'type' => 'number'
            ],
            [
                'label' => 'Kaina su nuolaida',
                'name' => 'disprice',
                'id' => 'disprice',
                'classes' => [
                    'fieldset' => 'd-inline-block mb-3',
                    'label' => 'd-block'
                ],
                'type' => 'number'
            ],
            [
                'label' => 'Galioja iki:',
                'name' => 'valid_to_date',
                'id' => 'valid_to_date',
                'classes' => [
                    'fieldset' => 'd-inline-block mb-3'
                ],
                'type' => 'date'
            ],
            [
                'name' => 'is_active',
                'id' => 'is_active',
                'type' => 'checkbox',
                'options' => [
                    [
                        'value' => 'is_active',
                        'label' => 'Rodyti pagrindiniame puslapyje'
                    ]
                ]
            ]
        ],
        'buttons' => [
            [
                'label' => 'Skelbti',
                'value' => 'publish',
                'classes' => [
                    'fieldset' => 'p-4 d-inline-block'
                ]
            ],
            [
                'label' => 'Išsaugoti',
                'value' => 'save',
                'classes' => [
                    'fieldset' => 'p-4 d-inline-block'
                ]
            ]
        ]
    ];

    public function __construct() {
        parent::__construct($this->form_data);
    }
}