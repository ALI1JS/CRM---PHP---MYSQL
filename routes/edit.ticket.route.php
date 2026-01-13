<?php
session_start();
require_once "../controller/ticket.controller.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $title = trim($_POST["title"] ?? '');
    $description = trim($_POST["description"] ?? '');
    $priority = $_POST["priority"] ?? null;
    $status = $_POST["status"] ?? null;
    $id = $_POST["id"] ?? null;


    $ticket = new Ticket();

    // Argument Named PHP 8.0 Version
    $added = $ticket->update(
        id: $id,
        data: [
            "title" => $title,
            "description" => $description,
            "priority" => $priority,
            "status" => $status
        ]
    );


    if ($added === 200) {
        $_SESSION['success'] = "Ticket Updated Successfully";
        header("Location: /crm/public/tickets/view.tickets.php");
    } else {
        $_SESSION["error"] = "Updated Ticket Failed";
        header("Location: /crm/public/ticket/edit.ticket.php?id=" . $id);
    }
    exit;
}
