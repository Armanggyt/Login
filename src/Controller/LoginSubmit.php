<?php

namespace Login\Controller;

class LoginSubmit extends BaseController {
    public function submit() {
        $this->title = "Login";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $username = $_POST['username'] ?? '';
        }

        if (empty($password)) {
            echo 'All fields are required.';
        }
    }
}