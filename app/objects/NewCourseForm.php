<?php

namespace App\Objects;

use App\Model\Course;
use App\Model\Lecture;
use App\Model\LecturesList;
use App\Model\Offer;

class NewCourseForm extends Form {

    public function __construct(string $method = '', string $action = '') {
        $form = [
            'method' => $method,
            'action' => $action,
            'fields' => [
                'course_name' => [
                    'type' => 'text',
                    'label' => 'Kurso pavadinimas',
                    'value' => '',
                    'placeholder' => '',
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
                    'value' => '',
                    'placeholder' => '',
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
                    'value' => 'default.png',
                    'span' => '',
                    'required' => 1,
                    'classes' => [
                        'fieldset' => 'd-block mb-3',
                        'label' => 'd-block'
                    ]
                ],
                'price' => [
                    'type' => 'number',
                    'label' => 'Kaina',
                    'value' => '',
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
                    'value' => '',
                    'required' => '',
                    'classes' => [
                        'fieldset' => 'd-inline-block mb-3',
                        'label' => 'd-block',
                        'input' => 'mr-2 p-1'
                    ]
                ],
                'valid_to_date' => [
                    'type' => 'date',
                    'label' => 'Galioja iki (data)',
                    'value' => '',
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
                    'value' => '',
                    'required' => 1,
                    'classes' => [
                        'fieldset' => 'd-inline-block mb-3',
                        'label' => 'd-block',
                        'input' => 'w-100 p-1 border-0'
                    ]
                ],
                'is_active' => [
                    'type' => 'checkbox',
                    'label' => 'Publifikuoti škūrsą',
                    'value' => 'published',
                    'checked' => false
                ],
                'videos_list' => [
                    'type' => 'checkbox',
                    'label' => '',
                    'options' => $this->addVideosList()
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

    public function fillWithRandomValues() {
        $year = rand(2021, 2025);
        $month = rand(1, 12);
        $day = rand(1, 28);
        $hour = rand(0, 23);
        $minute = rand(0, 59);
        $second = rand(0, 59);
        $price = rand(60, 100);
        $status = ['', 'published'];

        $values = [
            'course_name' => 'Course ' . rand(1, 9),
            'course_description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'price' => $price,
            'disprice' => round($price * 0.8),
            'valid_to_date' => $year . '-' . ($month < 10 ? '0' . $month : $month) . '-' . ($day < 10 ? '0' . $day : $day),
            'valid_to_time' => ($hour < 10 ? '0' . $hour : $hour) . ':' . ($minute < 10 ? '0' . $minute : $minute) . ':' . ($second < 10 ? '0' . $second : $second),
            'is_active' => $status[rand(0, 1)],
            'videos_list' => $this->addVideosList()
        ];

        foreach ($values['videos_list'] as &$option) {
            $option['checked'] = rand(0, 1) ? true : false;
        }

        $this->setValues($values);
    }

    public function fillWithValuesFromDb($id) {
        $course = Course::getWere('id = ' . $id);
        $offer = Offer::getWere('course_id = ' . $id);
        $lectureslist = LecturesList::getWere('course_id = ' . $id);
        $lectures = [];

        if (!empty($lectureslist)) {
            !is_array($lectureslist) ? $lectureslist = [$lectureslist] : false;

            foreach ($lectureslist as $row) {
                $lecture = Lecture::getWere('id = ' . $row->lecture_id);
                $lectures[] = [
                    'value' => $lecture->video_url,
                    'order' => $row->order_num ?? ''
                    ];
            }
        }

        $valid_to_date = explode(' ', $offer->valid_to)[0];
        $valid_to_time = explode(' ', $offer->valid_to)[1];

        $values = [
            'course_name' => $course->name,
            'course_description' => $course->about,
            'cover_photo' => $course->picture,
            'price' => $offer->price,
            'disprice' => $offer->discount_offer,
            'valid_to_date' => $valid_to_date,
            'valid_to_time' => $valid_to_time,
            'is_active' => $course->status,
            'videos_list' => $this->addVideosList($lectures)
        ];

        $this->setValues($values);
    }

    public function addVideosList(array $videos_from_db = []) {
        $videosService = new \App\services\GetVideosUrl;
        $videos_from_api = $videosService->getVideos();

        $inputs_from_db = [];

        if (!empty($videos_from_db)) {
            $inputs_from_db = $this->addCheckboxInputs($videos_from_db, true);

            foreach ($videos_from_db as $video_from_db) {
                $index = array_search($video_from_db['value'], $videos_from_api);
                unset($videos_from_api[$index]);
            }

            foreach (array_reverse($videos_from_db) as $video_from_db) {
                array_unshift($videos_from_api, $video_from_db);
            }
        }

        foreach ($videos_from_api as &$api_video) {
            if (!is_array($api_video)) {
                $api_video = [
                    'value' => $api_video
                ];
            }
        }

        $inputs_from_api = $this->addCheckboxInputs($videos_from_api);

        return ($inputs_from_db ?? false) + $inputs_from_api;
    }

    public function addCheckboxInputs(array $array, bool $checked = false): array {
        $options = [];

        foreach ($array as $data) {
            $input_data['value'] = $data['value'] ?? '';
            $input_data['label'] = $data['label'] ?? '';
            $input_data['order'] = $data['order'] ?? false;
            $checked ? $input_data['checked'] = true : false;

            $options[] = $this->addCheckboxInput($input_data);
        }

        return $options;
    }

    public function addCheckboxInput(array $data) {
        $input['value'] = $data['value'] ?? '';
        $input['label'] = $data['label'] ?? '';
        $input['order'] = $data['order'] ?? false;
        $input['checked'] = $data['checked'] ?? false;

        return $input;
    }
}