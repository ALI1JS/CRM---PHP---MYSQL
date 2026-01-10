<?php
require_once "../controller/auth.controller.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $auth = new Auth();
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $auth->login($email, $password);
}


?>