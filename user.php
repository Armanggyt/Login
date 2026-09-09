<?php
session_start();
if(empty($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}
else{
    echo "hello User";
}