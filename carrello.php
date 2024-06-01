<?php
include 'database.php';

$sql = "SELECT id, name, price FROM products";
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrello della Spesa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Prodotti</h1>
    <div class="products">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <h2><?php echo $product['name']; ?></h2>
                <p>Prezzo: €<?php echo number_format($product['price'], 2); ?></p>
                <button onclick="addToCart(<?php echo $product['id']; ?>)">Aggiungi al carrello</button>
            </div>
        <?php endforeach; ?>
    </div>
    
    <h1>Carrello</h1>
    <div id="cart">
        <p>Il carrello è vuoto.</p>
    </div>

    <script>
        const products = <?php echo json_encode($products); ?>;
    </script>
    <script src="script.js"></script>
</body>
</html>
