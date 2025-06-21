<?php
session_start();
include 'db.php';
$result = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mini E-Commerce</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Our Products</h1>
    <div class="product-list">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="product">
                <img src="images/<?php echo $row['image']; ?>" alt="" width="200">
                <h2><?php echo $row['name']; ?></h2>
                <p>RS-<?php echo $row['price']; ?></p>
                <button onclick="addToCart(<?php echo $row['id']; ?>)">Add to Cart</button>
            </div>
        <?php endwhile; ?>
    </div>
    <a href="cart.php">View Cart</a>
    <script src="add_to_cart.js"></script>
</body>
</html>
