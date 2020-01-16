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
}