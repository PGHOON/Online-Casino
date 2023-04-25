<?php
require_once 'login_model.php';
session_start();
$model = new Model('localhost', 'lance', 'root', '');

//encrypt password
$password = $_POST["password"];
$salt = "codeflix";
$password_encrypted = sha1($password.$salt);

$data = $model->get_data($_POST['username'], $password_encrypted);

if ($data == -1) {
    $error_message = "Your password is wrong. Try again.";
    header('Location: login.php?error=' . urldecode($error_message));
} else if ($data == -2) {
    $error_message = "User does not exist. Try registering first.";
    header('Location: login.php?error=' . urldecode($error_message));
} else {
    //require 'login_view.php';
    require '../main/main.php';
    //header('Location: ../main/main.php');
}

?>