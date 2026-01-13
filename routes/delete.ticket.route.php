<?php
session_start();
require_once "../controller/ticket.controller.php";


if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $id = $_POST["id"] ?? null;


    $ticket = new Ticket();

    // Argument Named PHP 8.0 Version
    $deletedTicket = $ticket->delete(id: (int) $id);

    if ($deletedTicket === 200) {
        $_SESSION['success'] = "Ticket Deleted Successfully";
        header("Location: /crm/public/tickets/view.tickets.php");
        exit;

    } else {
        $_SESSION["error"] = "Delete Ticket Failed";
        header("Location: /crm/public/tickets/view.tickets.php");
        exit;
    }

}