<?php
session_start();
$success = null;
$error = null;

if (isset($_SESSION["success"])) {
    $success = $_SESSION["success"];
}

if (isset($_SESSION["error"])) {
    $error = $_SESSION["error"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Ticket</title>
    <link rel="stylesheet" href="add.customer.css">
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

    <main class="crm-main">

        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="post" action="/crm/routes/add.customer.route.php" class="customer-form">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Enter full name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Enter email address" required>

            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" placeholder="Enter phone number" required>

            <button type="submit" class="btn btn-add">Add Customer</button>
            <a href="customer.php" class="btn btn-delete">Cancel</a>
        </form>

    </main>

</body>

</html>