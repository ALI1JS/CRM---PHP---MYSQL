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


$success = $_SESSION['success'] ?? null;
$error = $_SESSION['error'] ?? null;
unset($_SESSION['success'], $_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Ticket</title>
    <link rel="stylesheet" href="view.ticket.css">
    <link rel="stylesheet" href="add.ticket.css">
</head>

<body>

    <header class="crm-header">
        <h1>Edit Ticket</h1>
        <nav>
            <a href="/crm/public/customer/customer.php">Customers</a>
            <a href="/crm/public/tickets/view.tickets">Tickets</a>
            <form method="post" action="/crm/routes/logout.route.php" class="logout-form">
                <button type="submit">Logout</button>
            </form>

        </nav>
    </header>

    <main class="crm-main">

        <?php if ($success): ?>
            <div class="alert success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" action="/crm/routes/edit.ticket.route.php">

            <input type="hidden" name="id" value="<?= $ticket['id'] ?>">

            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($ticket['title']) ?>" required>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5"
                required><?= htmlspecialchars($ticket['description']) ?></textarea>

            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="open" <?= $ticket['status'] === 'open' ? 'selected' : '' ?>>Open</option>
                <option value="in_progress" <?= $ticket['status'] === 'in_progress' ? 'selected' : '' ?>>In Progress
                </option>
                <option value="closed" <?= $ticket['status'] === 'closed' ? 'selected' : '' ?>>Closed</option>
            </select>

            <label for="priority">Priority</label>
            <select id="priority" name="perpriority">
                <option value="low" <?= $ticket['priority'] === 'low' ? 'selected' : '' ?>>Low</option>
                <option value="medium" <?= $ticket['priority'] === 'medium' ? 'selected' : '' ?>>Medium</option>
                <option value="high" <?= $ticket['priority'] === 'high' ? 'selected' : '' ?>>High</option>
            </select>

            <button type="submit">Update Ticket</button>
            <a href="/crm/public/tickets/view.tickets.php" class="btn cancel">Cancel</a>
        </form>

    </main>

</body>

</html>