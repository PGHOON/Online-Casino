<?php
require_once 'login_model.php';

$model = new Model('localhost', 'lance', 'root', '');
$data = $model->get_data($_POST['username'], $_POST['password']);



if ($data == -1) {
    $error_message = "Your password is wrong. Try again.";
    header('Location: login.php?error=' . urldecode($error_message));
} else if ($data == -2) {
    $error_message = "User does not exist. Try registering first.";
    header('Location: login.php?error=' . urldecode($error_message));
} else {
    require 'login_view.php';
}

?>