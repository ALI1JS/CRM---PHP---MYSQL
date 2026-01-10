<?php
session_start();
require_once "../controller/customer.controller.php";


if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $email = $_POST["email"] ?? null;
    $name = $_POST["name"] ?? null;
    $phone = $_POST["phone"] ?? null;
    $id = $_POST["id"] ?? null;


    $customer = new Customer();
    $addCustomer = $customer->update((int) $id, [
        "email" => $email,
        "name" => $name,
        "phone" => $phone
    ]);

    if ($addCustomer === 200) {
        $_SESSION['success'] = "Customer Updated Successfully";
        header("Location: /crm/public/customer/customer.php");
        exit;

    } else {
        $_SESSION["error"] = "Update Customer Failed";
        header("Location: /crm/public/customer/edit.customer.php");
        exit;
    }

}