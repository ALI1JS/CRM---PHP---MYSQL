<?php
session_start();
require_once "../../controller/ticket.controller.php";


if (!isset($_GET['id'])) {
    die("Ticket ID is required");
}

$ticketId = (int) $_GET['id'];
$ticketObj = new Ticket();
$ticket = $ticketObj->getOne($ticketId);

if (!$ticket) {
    die("Ticket not found");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ticket Details</title>
    <link rel="stylesheet" href="details.ticket.css">
</head>

<body>

    <header class="crm-header">
        <h1>Ticket Details</h1>
        <nav>
            <a href="/crm/public/customer/customer.php">Customers</a>
            <a href="/crm/public/tickets/view.tickets.php">Tickets</a>
            <form method="post" action="/crm/routes/logout.route.php" class="logout-form">
                <button type="submit">Logout</button>
            </form>

        </nav>
    </header>

    <main class="crm-main">

        <div class="ticket-card">

            <h2 class="ticket-title"><?= htmlspecialchars($ticket['title']) ?></h2>

            <div class="ticket-row">
                <span class="ticket-label">Ticket ID:</span>
                <span class="ticket-value"><?= $ticket['id'] ?></span>
            </div>

            <div class="ticket-row">
                <span class="ticket-label">Customer ID:</span>
                <span class="ticket-value"><?= $ticket['customer_id'] ?></span>
            </div>

            <div class="ticket-row">
                <span class="ticket-label">Assigned To (Admin ID):</span>
                <span class="ticket-value"><?= $ticket['assigned_to'] ?? 'Not Assigned' ?></span>
            </div>

            <div class="ticket-row">
                <span class="ticket-label">Status:</span>
                <span
                    class="ticket-value status-badge status-<?= $ticket['status'] ?>"><?= ucfirst(str_replace('_', ' ', $ticket['status'])) ?></span>
            </div>

            <div class="ticket-row">
                <span class="ticket-label">Priority:</span>
                <span
                    class="ticket-value priority-badge priority-<?= $ticket['priority'] ?>"><?= ucfirst($ticket['priority']) ?></span>
            </div>

            <div class="ticket-row">
                <span class="ticket-label">Created At:</span>
                <span class="ticket-value"><?= $ticket['created_at'] ?></span>
            </div>

            <div class="ticket-row ticket-description">
                <span class="ticket-label">Description:</span>
                <p class="ticket-value"><?= nl2br(htmlspecialchars($ticket['description'])) ?></p>
            </div>

            <div class="ticket-actions">
                <a href="edit.ticket.php?id=<?= $ticket['id'] ?>" class="btn edit">Edit Ticket</a>
                <form method="post" action="/crm/routes/delete.ticket.route.php"
                    onsubmit="return confirm('Are you sure you want to delete this ticket?');">
                    <input type="hidden" name="id" value="<?= $ticket['id'] ?>">
                    <button type="submit" class="btn delete">Delete Ticket</button>
                </form>
            </div>

        </div>

    </main>

</body>

</html>