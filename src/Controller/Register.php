<?php
namespace Login\Controller;
use Login\Services\Db;
use Login\Services\Auth;
use Login\Entity\User;

class Register extends BaseController {
    public function form() {
        $this->title = "Register";
        $this->content = '<form action="/regsubmit" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <input type="submit" name="RegSubmit">
        </form>';
    }
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
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->content = 'Invalid email format.';
        } elseif (User::loadByEmail($email)) {
            $this->content = 'Email is already registered.';
        } else {
            $db = new Db();
            $sth = $db->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
            $sth->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT)]);

            Auth::authUser($db->lastInsertId());
        }
    }
}

