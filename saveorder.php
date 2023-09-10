<?php

// Connect to the database
$host = 'localhost:3306';
$username = 'root';
$password = '';
$dbname = 'farmbasket';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Insert the order into the database
$product_name = $_POST['product_name'];
$shoe_size = $_POST['shoe_size'];
$unit_price = $_POST['unit_price'];
$quantity = $_POST['quantity'];
$amount = $_POST['amount'];
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$payment_info = $_POST['payment_info'];
$total = $_POST['total'];

$sql = "INSERT INTO orders (product_name, shoe_size, unit_price, quantity, amount, name, email, address, payment_info, total)
        VALUES ('$product_name', '$shoe_size', '$unit_price', '$quantity', '$amount', '$name', '$email', '$address', '$payment_info', '$total')";

if ($conn->query($sql) === TRUE) {
    $response = ['success' => true];
} else {
    $response = ['success' => false];
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);

?>