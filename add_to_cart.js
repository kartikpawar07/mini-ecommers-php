function addToCart(productId) {
    fetch('session_add.php?id=' + productId)
        .then(response => response.text())
        .then(data => alert(data));
}