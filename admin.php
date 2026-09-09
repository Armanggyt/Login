<?php
session_start();
if (empty($_SESSION['login']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header("Location: ../login.php");
    exit;
}
else{
    echo "hello Admin";
}