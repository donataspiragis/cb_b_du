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
        if (!in_array($field_name, array_column($this->form['fields'], 'name'))) {
            $options = [];

            foreach ($inputs as $index => $value) {
                $options[] = [
                    'value' => $index,
                    'label' => $value
                ];
            }

            $this->form['fields'][] = [
                'name' => $field_name,
                'id' => 'checkbox_inputs_group_' . $field_name,
                'type' => 'checkbox',
                'options' => $options
            ];
        }
    }
}