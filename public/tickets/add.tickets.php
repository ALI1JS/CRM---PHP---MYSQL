<?php
session_start();

if (!isset($_GET['id'])) {
    die("Customer ID is required");
}

$customerId = (int) $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Ticket</title>
    <link rel="stylesheet" href="add.ticket.css">
</head>

<body>

    <header class="crm-header">
        <h1>Add New Ticket</h1>
        <nav>
            <a href="/crm/public/customer/customer.php">Customers</a>
            <a href="/crm/public/tickets/view.tickets.php">Tickets</a>
            <form method="post" action="/crm/routes/logout.route.php" class="logout-form">
                <button type="submit">Logout</button>
            </form>

        </nav>
    </header>

    <form method="post" action="/crm/routes/add.ticket.route.php">

        <input type="hidden" name="id" value="<?= $customerId ?>">

        <label>Title</label>
        <input type="text" name="title" required>

        <label>Description</label>
        <textarea name="description" rows="5" required></textarea>

        <label>Priority</label>
        <select name="priority">
            <option value="LOW">Low</option>
            <option value="MEDIUM" selected>Medium</option>
            <option value="HIGH">High</option>
        </select>

        <button type="submit">Create Ticket</button>
    </form>

</body>

</html>