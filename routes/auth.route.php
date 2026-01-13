<?php
require_once "../controller/auth.controller.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $auth = new Auth();
    $email = trim(string: $_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Argument Named PHP 8.0 Version
    $auth?->login( // Nullsafe Operator (?->)
        email: $email,
        password: $password
    );
}


?>