<style>
    #message {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #90EE90;
        color: #fff;
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        z-index: 9999;
    }
</style>
<?php

// Validate and sanitize the total price input
if (isset($_POST['total'])) {
    $totalPrice = filter_var($_POST['total'], FILTER_VALIDATE_FLOAT);
    if ($totalPrice === false) {
        $response = [
            'status' => 'error',
            'message' => 'Invalid total price value.'
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'Missing total price value.'
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Connect to the database
$host = 'localhost:3306';
$username = 'root';
$password = '';
$database = 'farmbasket';

$connection = new mysqli($host, $username, $password, $database);

// Check for errors in the connection
if ($connection->connect_error) {
    $response = [
        'status' => 'error',
        'message' => 'Database connection failed: ' . $connection->connect_error
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Prepare the SQL query
$sql = "UPDATE orders SET total = ? WHERE order_id = (SELECT MAX(order_id) FROM orders)";

// Create a prepared statement
$stmt = $connection->prepare($sql);

// Bind parameters to the prepared statement
$stmt->bind_param('d', $totalPrice);

// Execute the prepared statement
if ($stmt->execute()) {
    // The update was successful, return a success response
    $_SESSION['message'] = "Order Placed Successfully";

    // Close the database connection


    // Redirect to login page after 3 seconds
    echo "<script>setTimeout(function() {
        window.location.href = 'index.php';
    }, 2000);</script>";
} else {
    // There was an error updating the total price, return an error response
    $response = [
        'status' => 'error',
        'message' => 'Error updating total price: ' . $stmt->error
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Close the prepared statement and the database connection
$stmt->close();
$connection->close();
?>

<div id="message">
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>
</div>
<script>
    localStorage.removeItem('cartItems');

</script>