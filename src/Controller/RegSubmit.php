<?php
namespace Login\Controller;

use Login\Services\Db;

class RegSubmit extends BaseController {
    public function submit() {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        $this->title = "Register";

        if ($username === '' || $email === '' || $password === '' || $confirmPassword === '') {
            $this->content = 'All fields are required.';
        } elseif ($password !== $confirmPassword) {
            $this->content = 'Passwords do not match.';
        } else {
            $db = new Db();
            $sth = $db->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
            $sth->execute([$username, $email, $password]);
            $this->content = 'Registration successful.';
        }
        $this->html();
    }
}