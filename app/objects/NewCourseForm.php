<?php

namespace App\Objects;

class NewCourseForm extends Form {

    public $form_data = [
        'fields' => [
            'course_name' => [
                'type' => 'text',
                'label' => 'Kurso pavadinimas',
                'value' => 'Example course',
                'placeholder' => 'example text',
                'classes' => [
                    'fieldset' => 'd-block mb-3',
                    'label' => 'd-block'
                ]
            ],
            'course_description' => [
                'type' => 'textarea',
                'label' => 'Aprašymas',
                'value' => 'Example description',
                'placeholder' => 'describe this course',
                'classes' => [
                    'fieldset' => 'd-block mb-3',
                    'label' => 'd-block'
                ]
            ],
            'cover_photo' => [
                'type' => 'file',
                'label' => 'Cover paveiksliukas',
                'classes' => [
                    'fieldset' => 'd-block mb-3',
                    'label' => 'd-block'
                ]
            ],
            'price' => [
                'type' => 'number',
                'label' => 'Kaina',
                'value' => 50,
                'classes' => [
                    'fieldset' => 'd-inline-block mb-3',
                    'label' => 'd-block'
                ]
            ],
            'disprice' => [
                'type' => 'number',
                'label' => 'Kaina su nuolaida',
                'value' => 100,
                'classes' => [
                    'fieldset' => 'd-inline-block mb-3',
                    'label' => 'd-block'
                ]
            ],
            'valid_to_date' => [
                'type' => 'date',
                'label' => 'Galioja iki:',
                'classes' => [
                    'fieldset' => 'd-inline-block mb-3'
                ]
            ],
            'is_active' => [
                'type' => 'checkbox',
                'value' => 1,
                'label' => 'Rodyti pagrindiniame puslapyje'
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

    public function __construct() {
        parent::__construct($this->form_data);
    }
}