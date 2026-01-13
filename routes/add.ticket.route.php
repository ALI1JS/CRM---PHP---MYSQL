<?php
session_start();

require_once "../controller/ticket.controller.php";
require_once __DIR__ . "/../enums/priority.ticket.php";


if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $title = trim($_POST["title"] ?? '');
    $description = trim($_POST["description"] ?? '');
    $customerId = $_POST["id"] ?? null;
    $adminId = $_SESSION["user_id"] ?? null;
    $priorityValue = $_POST["priority"] ?? 'MEDIUM';

    $priority = match ($priorityValue) { // Match expression instead of the switch
        "LOW" => Priority::LOW, // Enums
        "MEDIUM" => Priority::MEDIUM,
        "HIGH" => Priority::HIGH,
    };

    if (!$title || !$description || !$customerId || !$adminId) {
        $_SESSION["error"] = "Invalid ticket data";
        header("Location: /crm/public/customer/customer.php");
        exit;
    }

    $ticket = new Ticket();

    // Argument Named PHP 8.0 Version
    $added = $ticket?->add( // Nullsafe Operator (?->)
        title: $title,
        description: $description,
        priority: $priority,
        customerId: (int) $customerId,
        adminId: (int) $adminId
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
