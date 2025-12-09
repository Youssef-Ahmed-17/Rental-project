<?php
class Controller {

    // Load a view
    public function view($view, $data = []) {
        extract($data);
        require_once __DIR__ . '/../views/' . $view . '.php';
    }

    // Load a model
    public function model($model) {
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new $model();
    }
}
