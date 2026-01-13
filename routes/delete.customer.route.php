<?php
session_start();
require_once "../controller/customer.controller.php";


if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $id = $_POST["id"] ?? null;


    $customer = new Customer();

    // Argument Named PHP 8.0 Version
    $addCustomer = $customer->delete(id: (int) $id);

    if ($addCustomer === 200) {
        $_SESSION['success'] = "Customer Deleted Successfully";
        header("Location: /crm/public/customer/customer.php");
        exit;

    } else {
        $_SESSION["error"] = "Delete Customer Failed";
        header("Location: /crm/public/customer/customer.php");
        exit;
    }

}