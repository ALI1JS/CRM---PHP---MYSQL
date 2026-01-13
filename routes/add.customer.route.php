<?php
session_start();
require_once "../controller/customer.controller.php";


if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $email = $_POST["email"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];


    $customer = new Customer();

    // Argument Named PHP 8.0 Version
    $addCustomer = $customer?->add( // Nullsafe Operator (?->)
        email: $email,
        name: $name,
        phone: $phone
    );

    if ($addCustomer === 200) {
        $_SESSION['success'] = "Customer Added Successfully";

    } else {
        $_SESSION["error"] = "Add Customer Failed";
    }

    header("Location: /crm/public/customer/add.customer.php");
    exit;

}