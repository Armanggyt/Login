<?php
namespace Login\Controller;

use Login\Entity\User;
use Login\Services\Debug;
use Login\Services\Auth;
use Login\Services\Db;
use Login\Controller\sendEmail;

require_once __DIR__ . '/sendEmail.php';

class Login extends BaseController {

    public function form() {
        $this->title = "Login";
        $this->content = '<form action="/loginSubmit" method="post">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" name="LoginSubmit">
            <a href="/reset" name="Reset">Reset Password</a>            
            </form>';
    }

    public function submit() {
        $this->title = "Login";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    public function resetFormPage() {
        $this->setTitle('Reset password');
        $this->content = '<form action="/reset" method="post">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="submit" name="resetSubmit" value="Reset Password">
            </form>';
    }

public function sendResetEmail() {
        $token = bin2hex(random_bytes(32));
        $email = $_POST['email'] ?? '';
        
        $db = new Db();
        $sth = $db->prepare('INSERT INTO tokens (token, email) VALUES (?, ?)');
        $sth->execute([$token, $email]);
        $resetLink = "http://login.docksal.site/reset-password?token=" . $token;
        $mailSender = new SendEmail(); 
        $mailSender->sendEmail($email, 'Click this link to reset your password: <a href="' . $resetLink . '">' . $resetLink . '</a>');
        $this->content = '<p>Password reset link has been sent to your email.</p>';
    }

}