<?php
// get the cartItems array from localStorage
if (isset($_POST['cartItems'])) {
    // get the cartItems array from localStorage
    $cartItems = json_decode($_POST['cartItems'], true);

    // rest of the script goes here...
} else {
    // handle the case where the "cartItems" key is not set
    echo "No cart items found.";
}


// encode the cartItems array as a JSON string
$cartItemsJson = json_encode($cartItems);

// connect to the database
$conn = mysqli_connect('localhost:3344', 'root', '', 'farmbasket');

// insert the cartItems JSON string into the database
$sql = "INSERT INTO orders (info) VALUES ('$cartItemsJson')";
mysqli_query($conn, $sql);

// close the database connection
mysqli_close($conn);

// return a success message
echo "Cart items saved to database.";
?>