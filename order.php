<?php
// Establish a connection to the database
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "farmbasket";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the cart items from the request body
$data = json_decode(file_get_contents("php://input"));

// Insert each cart item into the orders table
foreach ($data as $item) {
    $sql = "INSERT INTO orders (product, size, quantity, price) VALUES ('$item->title', '$item->size', $item->quantity, '$item->price')";
    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

echo "Order processed successfully";

$conn->close();
?>