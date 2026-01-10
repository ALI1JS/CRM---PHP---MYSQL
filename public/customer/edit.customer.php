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
    <title>Edit Customer</title>
    <link rel="stylesheet" href="edit.customer.css">
</head>

<body>

    <header class="crm-header">
        <h1>Edit Customer</h1>
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

        <form method="post" action="/crm/routes/edit.customer.route.php" class="customer-form">
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="Ali Ismail" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="ali@example.com" required>

            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" value="+20 123456789" required>

            <button type="submit" class="btn btn-edit">Update Customer</button>
            <a href="customer.php" class="btn btn-delete">Cancel</a>
        </form>

    </main>

</body>

</html>