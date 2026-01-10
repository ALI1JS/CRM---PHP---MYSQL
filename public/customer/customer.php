<?php
session_start();
require_once "../../controller/customer.controller.php";


// Simple auth check
if (!isset($_SESSION['user_id'])) {
    header("Location: crm/public/login.php");
    exit;
}

$customers = [
    ['id' => 1, 'name' => 'Ali Ismail', 'email' => 'ali@example.com', 'phone' => '+20 123456789'],
    ['id' => 2, 'name' => 'Sara Ahmed', 'email' => 'sara@example.com', 'phone' => '+20 987654321'],
    ['id' => 3, 'name' => 'Mohamed Hassan', 'email' => 'mohamed@example.com', 'phone' => '+20 555555555'],
];

$customer = new Customer();
$customers = $customer->getAll();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM - Customers</title>
    <link rel="stylesheet" href="customer.css">
</head>

<body>

    <header class="crm-header">
        <h1>CRM System - Customers</h1>
        <nav>
            <a href="/crm/public/customer/customer.php">Customers</a>
            <a href="/crm/public/tickets/view.tickets.php">Tickets</a>
            <form method="post" action="/crm/routes/logout.route.php" class="logout-form">
                <button type="submit">Logout</button>
            </form>

        </nav>
    </header>

    <main class="crm-main">
        <div class="crm-actions">
            <a href="add.customer.php" class="btn btn-add">+ Add New Customer</a>
        </div>

        <div class="crm-search">
            <input type="text" id="search" placeholder="Search customers..." onkeyup="filterCustomers()">
        </div>

        <div class="crm-table">
            <table id="customerTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $c): ?>
                        <tr>
                            <td><?= htmlspecialchars($c['id']) ?></td>
                            <td><?= htmlspecialchars($c['name']) ?></td>
                            <td><?= htmlspecialchars($c['email']) ?></td>
                            <td><?= htmlspecialchars($c['phone']) ?></td>
                            <td>
                                <a href="edit.customer.php?id=<?= $c['id'] ?>" class="btn btn-edit">Edit</a>
                                <a href="/crm/public/tickets/add.tickets.php?id=<?= $c['id'] ?>" class="btn btn-edit">Add
                                    Ticket</a>
                                <form action="/crm/routes/delete.customer.route.php" method="post" style="display:inline;"
                                    onsubmit="return confirm('Are you sure you want to delete this customer?')">

                                    <input type="hidden" name="id" value="<?= $c['id'] ?>">

                                    <button type="submit" class="btn btn-delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        // Simple client-side search filter
        function filterCustomers() {
            let input = document.getElementById("search");
            let filter = input.value.toLowerCase();
            let table = document.getElementById("customerTable");
            let tr = table.getElementsByTagName("tr");

            for (let i = 1; i < tr.length; i++) {
                let tdName = tr[i].getElementsByTagName("td")[1];
                let tdEmail = tr[i].getElementsByTagName("td")[2];
                if (tdName && tdEmail) {
                    let textValue = tdName.textContent + " " + tdEmail.textContent;
                    tr[i].style.display = textValue.toLowerCase().indexOf(filter) > -1 ? "" : "none";
                }
            }
        }
    </script>

</body>

</html>