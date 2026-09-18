<?php
namespace Login\Controller;

class RegSubmit {
    public function html() {}
    public function submit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if (empty($username) || empty($password) || empty($confirmPassword)) {
                echo "All fields are required.";
                exit;
            }

            if ($password !== $confirmPassword) {
                echo "Passwords do not match.";
                exit;
            }

            $regObject = new \Login\Entity\User();
            $regObject->setCredentials($username, $password);
            print( "Hello, " . $username . "!" );
            print("<br>");
            print("Your password is: " . $password);
        }
    }
}