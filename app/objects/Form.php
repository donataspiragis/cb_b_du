<?php

namespace App\Objects;

use App\View\View;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

class Form extends View {
    protected $form;

    public function __construct(array $form) {
        $this->form = $form;
    }

    public function getData(): array {
        return $this->form;
    }

    public function setData(array $form) {
        $this->form = $form;
    }

    public function setValues(array $values) {
        foreach ($this->form['fields'] as $name => &$field) {
            if (in_array($name, array_keys($values))) {
                switch ($field['type']) {
                    case 'checkbox':
                        if ($name === 'is_active') {
                            $field['value'] = $values[$name];
                            $field['checked'] = !empty($field['value']) ? true : false;
                        } else {
                            $field['options'] = $values[$name];
                        }
                        break;
                    case 'file':
//                        print '<pre>';
//                        print_r($values);
//                        die();
                        if (!empty($values['cover_photo'])) {
                            $field['value'] = $values[$name];
                            $field['required'] = '';
                            $field['span'] = 'Įkelti kitą';
                        }
                        break;
                    default:
                        $field['value'] = $values[$name];
                        break;
                }
            }
        }
    }
}