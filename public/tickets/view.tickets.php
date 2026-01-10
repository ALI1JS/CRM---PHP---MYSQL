<?php
session_start();
require_once "../../controller/ticket.controller.php";

$ticketObj = new Ticket();
$tickets = $ticketObj->getAll();

$success = $_SESSION['success'] ?? null;
$error = $_SESSION['error'] ?? null;
unset($_SESSION['success'], $_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tickets</title>
    <link rel="stylesheet" href="view.ticket.css">
</head>

<body>

    <header class="crm-header">
        <h1>Tickets</h1>
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

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Customer</th>
                        <th>Assigned</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (empty($tickets)): ?>
                        <tr>
                            <td colspan="7" class="empty">No tickets found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($tickets as $t): ?>
                            <tr>
                                <td><?= $t['id'] ?></td>
                                <td><?= htmlspecialchars($t['title']) ?></td>

                                <td>
                                    <span class="badge status-<?= $t['status'] ?>">
                                        <?= $t['status'] ?>
                                    </span>
                                </td>

                                <td>
                                    <span class="badge priority-<?= $t['priority'] ?>">
                                        <?= $t['priority'] ?>
                                    </span>
                                </td>

                                <td><?= $t['customer_id'] ?></td>
                                <td><?= $t['assigned_to'] ?></td>

                                <td class="actions">
                                    <a href="edit.ticket.php?id=<?= $t['id'] ?>" class="btn edit">Edit</a>
                                    <a href="details.ticket.php?id=<?= $t['id'] ?>" class="btn edit">View</a>

                                    <form method="post" action="/crm/routes/delete.ticket.route.php"
                                        onsubmit="return confirm('Delete this ticket?')">

                                        <input type="hidden" name="id" value="<?= $t['id'] ?>">
                                        <button type="submit" class="btn delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </main>

</body>

</html>