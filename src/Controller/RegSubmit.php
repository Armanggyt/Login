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

          $l  = mysqli_connect('db','user', 'user');
            if (!mysqli_select_db($l, 'default')) {
            die('Cant select db');
}

            $sql = "CREATE TABLE IF NOT EXISTS users (
             id INT AUTO_INCREMENT PRIMARY KEY,
             name VARCHAR(50) NOT NULL,
             password VARCHAR(255) NOT NULL
)";
            mysqli_query($l, $sql);
            
            $insert_sql = "INSERT INTO users (name, password) VALUES ('$username', '$password')";
            mysqli_query($l, $insert_sql);
            mysqli_close($l);
        }
    }
}
