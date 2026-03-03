<?php
// Array to store products
$products = [];

// Check if form is submitted
if (isset($_POST['submit'])) {
    $productName = htmlspecialchars($_POST['product_name']);
    $productPrice = htmlspecialchars($_POST['product_price']);
    $productDesc = htmlspecialchars($_POST['product_desc']);

    // Add product to the array
    $products[] = [
        'name' => $productName,
        'price' => $productPrice,
        'desc' => $productDesc
    ];

    // Store in session to keep products after reload
    session_start();
    if (!isset($_SESSION['products'])) {
        $_SESSION['products'] = [];
    }
    $_SESSION['products'][] = [
        'name' => $productName,
        'price' => $productPrice,
        'desc' => $productDesc
    ];
}

// Load products from session
session_start();
if (isset($_SESSION['products'])) {
    $products = $_SESSION['products'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Cards</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 30px;
        }

        .form-card {
            background: #fff;
            border-radius: 12px;
            padding: 25px;
            max-width: 400px;
            margin-bottom: 30px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .form-card h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        button {
            margin-top: 20px;
            padding: 12px;
            width: 100%;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #0056b3;
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .product-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            padding: 20px;
            width: 250px;
        }

        .product-card h3 {
            margin-top: 0;
            color: #007bff;
        }

        .product-card p {
            margin: 8px 0;
            color: #555;
        }

        .product-card .price {
            font-weight: bold;
            color: #28a745;
        }
    </style>
</head>
<body>

<div class="form-card">
    <h2>Add New Product</h2>
    <form method="POST" action="">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" placeholder="Enter product name" required>

        <label for="product_price">Price:</label>
        <input type="text" name="product_price" id="product_price" placeholder="Enter price" required>

        <label for="product_desc">Description:</label>
        <textarea name="product_desc" id="product_desc" rows="3" placeholder="Enter product description"></textarea>

        <button type="submit" name="submit">Add Product</button>
    </form>
</div>

<div class="product-container">
    <?php foreach ($products as $product): ?>
        <div class="product-card">
            <h3><?php echo $product['name']; ?></h3>
            <p class="price">$<?php echo $product['price']; ?></p>
            <p><?php echo $product['desc']; ?></p>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>