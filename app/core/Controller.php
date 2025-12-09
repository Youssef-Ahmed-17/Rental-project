<?php
class Controller {
    public function view($view, $data = []) {
        extract($data);

        // إذا استخدمتي subfolder (مثل auth)
        require_once __DIR__ . '/../views/' . $view . '.php';
    }
}
