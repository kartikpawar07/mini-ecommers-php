<?php
session_start();
include 'db.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove'])) {
    $remove_id = $_POST['remove'];
    unset($_SESSION['cart'][$remove_id]);
}

$total = 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Your Cart</h1>
    <a href="index.php">Continue Shopping</a>
    <table>
        <tr><th>Product</th><th>Price</th><th>Quantity</th><th>Total</th><th>Action</th></tr>
        <?php foreach ($_SESSION['cart'] as $product_id => $quantity): 
            $result = $conn->query("SELECT * FROM products WHERE id = $product_id");
            $product = $result->fetch_assoc();
            $subtotal = $product['price'] * $quantity;
            $total += $subtotal;
        ?>
        <tr>
            <td><?php echo $product['name']; ?></td>
            <td>RS-<?php echo $product['price']; ?></td>
            <td><?php echo $quantity; ?></td>
            <td>RS-<?php echo number_format($subtotal, 2); ?></td>
            <td>
                <form method="post">
                    <button type="submit" name="remove" value="<?php echo $product_id; ?>">Remove</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h2>Total: RS-<?php echo number_format($total, 2); ?></h2>
    <a href="checkout.php">Proceed to Checkout</a>
</body>
</html>
