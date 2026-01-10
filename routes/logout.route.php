<?php
require_once "../controller/auth.controller.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $auth = new Auth();
    $auth->logout();
}

?>