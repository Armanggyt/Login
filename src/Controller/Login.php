<?php
namespace Login\Controller;
use Login\Services\Db;
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
            <a href="/Reset" name="Reset">Reset Password</a>            
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
        $this->content = 'All ok';
    }
     public function verifyResetToken() {
        $db = new Db();
        $resetToken = $_POST['token'] ?? '';
        if (!empty($resetToken)) {
            $sth = $db->prepare('SELECT * FROM tokens WHERE token = ?');
            $sth->execute([$resetToken]);
            $tokenData = $sth->fetch(\PDO::FETCH_ASSOC);
            if ($tokenData) {
                $userEmail = $tokenData['email'];
                $sth = $db->prepare('SELECT * FROM users WHERE email = ?');
                $sth->execute([$userEmail]);
                $userData = $sth->fetch(\PDO::FETCH_ASSOC);
                $sth = $db->prepare('DELETE FROM tokens WHERE token = ?');
                $sth->execute([$resetToken]);
                if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['reset_email'] = $userEmail;
            $this->content = '<form action="/resetPassword" method="post">
            <input type="password" name="new_password" placeholder="New Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <input type="submit" name="resetPasswordSubmit" value="Reset Password">
            </form>';
        }
    }
}


public function resetPassword() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $this->setTitle('Reset password');
    $email = $_SESSION['reset_email'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    if (empty($email)) {
        $this->content = '<p>Session expired. Please start the reset again.</p>';
        return;
    }


    if (empty($newPassword) || $newPassword !== $confirmPassword) {
        $this->content = '<p>Passwords do not match.</p>';
        return;
    }
    $db = new Db();
    $sth = $db->prepare('UPDATE users SET password = ? WHERE email = ?');
    $sth->execute([password_hash($newPassword, PASSWORD_DEFAULT), $email]);
    unset($_SESSION['reset_email']);
    $this->content = '<p>Password has been reset successfully.</p>';

} 
}
