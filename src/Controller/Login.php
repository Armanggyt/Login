<?php
namespace Login\Controller;

use Login\Entity\User;
use Login\Services\Debug;
use Login\Services\Auth;

class Login extends BaseController {
    public function form() {
        $this->title = "Login";
        $this->content = '<form action="/loginSubmit" method="post">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" name="LoginSubmit">
            </form>';
    }
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
            Auth::authUser($checkUser->id());
            \header('Location: \\');
        } else {
            print 'Login failed';
        }
    }
}