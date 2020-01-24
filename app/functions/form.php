<?php

function save_file($file, $path = 'images/', $allowed_types = ['image/png', 'image/jpeg', 'image/gif']) {

    if ($file['error'] == 0 && in_array($file['type'], $allowed_types)) {
        !file_exists($path) ? mkdir($path, 0777, true) : false;

        $target_path = $path . $file['name'];

        if (move_uploaded_file($file['tmp_name'], $target_path)) {
            return $target_path;
        }
    }

    return false;
}
