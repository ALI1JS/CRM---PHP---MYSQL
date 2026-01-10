<?php
session_start();
require_once "../controller/ticket.controller.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $title       = trim($_POST["title"] ?? '');
    $description = trim($_POST["description"] ?? '');
    $priority    = $_POST["priority"] ?? 'medium';
    $customerId  = $_POST["id"] ?? null;
    $adminId     = $_SESSION["user_id"] ?? null;

    if (!$title || !$description || !$customerId || !$adminId) {
        $_SESSION["error"] = "Invalid ticket data";
        header("Location: /crm/public/customer/customer.php");
        exit;
    }

    $ticket = new Ticket();
    $added = $ticket->add(
        $title,
        $description,
        $priority,
        (int)$customerId,
        (int)$adminId
    );

    if ($added === 200) {
        $_SESSION['success'] = "Ticket Added Successfully";
        header("Location: /crm/public/tickets/view.tickets.php");
    } else {
        $_SESSION["error"] = "Add Ticket Failed";
        header("Location: /crm/public/ticket/add.ticket.php?id=" . $customerId);
    }
    exit;
}
