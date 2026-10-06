<?php

namespace Login\Controller;

use Login\Entity\User;
use Login\Services\Debug;

class LoginSubmit extends BaseController {
    public function submit() {
        $this->title = "Login";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $username = $_POST['email'] ?? '';
        }

        if (empty($password) || empty($username)) {
            echo 'All fields are required.';
        }
        $checkUser = User::loadByEmail($username);
        if ($checkUser && $checkUser->checkPassword($password)) {
            print 'Thats ok';
        } else {
            print 'Login failed';
        }
    }
}