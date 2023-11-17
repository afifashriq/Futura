<?php
session_start();
require 'config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

// Search orders
$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM orders WHERE name LIKE '%$search%' OR email LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM orders";
}

$result = $conn->query($sql);

$orders = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Sahil Kumar">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Panel</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
    <style>
        
        .order-box {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #f8f9fa; /* Light Gray */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .order-box p {
            margin-bottom: 8px;
        }

        .order-box strong {
            color: #007bff; /* Blue */
        }

        .container {
            background-color: #f4f4f4; /* Lighter Gray */
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
        }

        h2 {
            color: #343a40; /* Dark Gray */
        }

        .btn-outline-secondary {
            color: #007bff; /* Blue */
        }

        .btn-outline-secondary:hover {
            background-color: #007bff; /* Blue */
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="text-center mt-4">Admin Panel - Checkout Orders</h2>
                <form method="GET" action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search by name or email" name="search" value="<?= $search ?>">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
                <?php foreach ($orders as $order): ?>
                    <div class="order-box">
                        <p><strong>Name:</strong> <?= $order['name'] ?? '' ?></p>
                        <p><strong>Email:</strong> <?= $order['email'] ?? '' ?></p>
                        <p><strong>Phone:</strong> <?= $order['phone'] ?? '' ?></p>
                        <p><strong>Address:</strong> <?= $order['address'] ?? '' ?></p>
                        <p><strong>Payment Mode:</strong> <?= $order['pmode'] ?? '' ?></p>
                        <p><strong>Products:</strong> <?= $order['products'] ?? '' ?></p>
                        <p><strong>Amount Paid:</strong> <?= isset($order['amount_paid']) ? number_format($order['amount_paid'], 2) : '' ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
</body>

</html>
