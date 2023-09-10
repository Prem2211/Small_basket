<?php
// Connect to the database
$pdo = new PDO('mysql:host=localhost:3306;dbname=farmbasket', 'root', '');

// Get the form data
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$image = $_POST['image'];

// Prepare the SQL statement
$stmt = $pdo->prepare("INSERT INTO products (name, description, price, image) VALUES (:name, :description, :price, :image)");

// Bind the parameters
$stmt->bindParam(':name', $name);
$stmt->bindParam(':description', $description);
$stmt->bindParam(':price', $price);
$stmt->bindParam(':image', $image);

// Execute the statement
$stmt->execute();

// Redirect to the product list page
header('Location: admin.html');
?>