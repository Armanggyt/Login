<?php
namespace Login\Controller;

class ResetPassword extends BaseController {

    public function form() {
        $token = $_GET['token'] ?? '';

        $this->title = "Reset Password";
        $this->content = '<form action="/update-password?token=' . htmlspecialchars($token) . '" method="post">
            <input type="password" name="new_password" placeholder="New Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <input type="submit" name="submitReset" value="Reset Password">
            </form>';
    }

    public function updatePassword() {
        $token = $_GET['token'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if (empty($newPassword) || empty($confirmPassword)) {
            $this->content = 'All fields are required.';
            return;
        }

        if ($newPassword !== $confirmPassword) {
            $this->content = 'Passwords do not match.';
            return;
        }

        $db = new \Login\Services\Db();

        $sth = $db->prepare('SELECT email FROM tokens WHERE token = ?');
        $sth->execute([$token]);
        $tokenData = $sth->fetch(\PDO::FETCH_ASSOC);

        if (!$tokenData) {
            $this->content = 'Invalid or expired token.';
            return;
        }
        $email = $tokenData['email'];
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sth = $db->prepare('UPDATE users SET password = ? WHERE email = ?');
        $sth->execute([$hashedPassword, $email]);
        $sth = $db->prepare('DELETE FROM tokens WHERE token = ?');
        $sth->execute([$token]);

        $this->content = 'Password has been reset successfully. You can now login.';
    }
}