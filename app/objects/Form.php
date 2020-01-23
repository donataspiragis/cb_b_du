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

    public function getData() {
        return $this->form;
    }

    public function addCheckboxInputs(string $field_name, array $inputs) {
        if (!in_array($field_name, array_keys($this->form['fields']))) {
            $options = [];

            foreach ($inputs as $index => $value) {
                $options[] = [
                    'num' => $index + 1,
                    'value' => $value
                ];
            }

            $this->form['fields'][$field_name] = [
                'type' => 'checkbox',
                'options' => $options
            ];
        }
    }
}