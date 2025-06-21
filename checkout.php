<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $total = 0;

    foreach ($_SESSION['cart'] as $id => $qty) {
        $result = $conn->query("SELECT * FROM products WHERE id = $id");
        $row = $result->fetch_assoc();
        $total += $row['price'] * $qty;
    }

    $conn->query("INSERT INTO orders (customer_name, customer_email, address, total_price)
                  VALUES ('$name', '$email', '$address', $total)");
    $order_id = $conn->insert_id;

    foreach ($_SESSION['cart'] as $id => $qty) {
        $conn->query("INSERT INTO order_items (order_id, product_id, quantity)
                      VALUES ($order_id, $id, $qty)");
    }

    $_SESSION['cart'] = [];
    echo "<h1>Order placed successfully!</h1><a href='index.php'>Shop More</a>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>
    <h1>Checkout</h1>
    <form method="post">
        <label>Name:</label><input type="text" name="name" required><br>
        <label>Email:</label><input type="email" name="email" required><br>
        <label>Address:</label><textarea name="address" required></textarea><br>
        <button type="submit">Place Order</button>
    </form>
</body>
</html>
