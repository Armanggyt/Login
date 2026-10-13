<?php
namespace Login\Controller;

use Login\Services\Db;

class RegSubmit extends BaseController {
    public function submit() {
            session_start();

        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        $this->title = "Register";

        if ($username === '' || $email === '' || $password === '' || $confirmPassword === '') {
            $this->content = 'All fields are required.';
        } elseif ($password !== $confirmPassword) {
            $this->content = 'Passwords do not match.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->content = 'Invalid email format.';
        } else {
            $db = new Db();
            $sth = $db->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
            $sth->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT)]);

            $sessionId = session_id();
            $sth = $db->prepare('INSERT INTO sessions (uid, session_id) VALUES (?, ?)');
            $sth->execute([$db->lastInsertId(), $sessionId]);
        }
    }
}