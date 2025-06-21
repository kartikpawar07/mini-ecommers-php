<?php
session_start();
include 'db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id = $id");
$product = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head><title><?php echo $product['name']; ?></title></head>
<body>
    <h1><?php echo $product['name']; ?></h1>
    <img src="images/<?php echo $product['image']; ?>" width="300"><br>
    <p><?php echo $product['description']; ?></p>
    <p>Price: $<?php echo $product['price']; ?></p>
    <button onclick="addToCart(<?php echo $product['id']; ?>)">Add to Cart</button>
    <script src="add_to_cart.js"></script>
</body>
</html>
