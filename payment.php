<?php
// Database connection
session_start();
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "farmbasket";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user data from the database
$username = $_SESSION['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$pincode = $_POST['zipcode'];
$city = $_POST['city'];
$state = $_POST['state'];

// Update user data in the database
$sql = "UPDATE users SET address='$address', pincode='$pincode' , city='$city', state='$state' WHERE name='$username'";
if ($conn->query($sql) === TRUE) {
    // Data updated successfully
} else {
    // Handle error
}
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
$conn = mysqli_connect('localhost:3306', 'root', '', 'farmbasket');

// insert the cartItems JSON string into the database
$sql = "INSERT INTO orders (email,info,address,pincode,city,state) VALUES ('$email','$cartItemsJson','$address','$pincode','$city','$state')";
mysqli_query($conn, $sql);



// Close database connection
$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
    <title>PAYMENT</title>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cartItemsList = document.getElementById('cart-items');
            const total = document.getElementById('total');
            let cartItems = [];

            // Load cart data from local storage
            if (localStorage.getItem('cartItems')) {
                cartItems = JSON.parse(localStorage.getItem('cartItems'));
                updateCart();
            }

            // Update cart
            function updateCart() {
                let cartTotal = 0;

                if (Array.isArray(cartItems)) {
                    cartItems.forEach((item) => {
                        cartTotal += item.price * item.qty;
                    });
                }

                total.textContent = 'Total price: ₹' + cartTotal;

                // Set the total price as a hidden input value
                document.getElementById('total-input').value = cartTotal;
            }

        });
    </script>

    <script src="https://kit.fontawesome.com/1b2f4972b7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/payment.css" />
</head>

<body>

    <form method="POST" action="confirmation.php">
        <ul id="cart-items"></ul>
        <h1 style="text-align: center;"> <span id="total"></span></h1>
        <input type="hidden" name="total" id="total-input" value="">


        <div class="payment-container">
            <div class="head-container">
                <br>
                <h1><i class="fa-sharp fa-solid fa-basket-shopping"></i>&nbsp; FARM BASKET</i>
                    <h1>
                        <h1>PAYMENT</h1>
            </div>
            <div class="icon-container">
                <div class="icon">
                    <i class="fa-solid fa-credit-card"></i>
                    <label>Card</label>
                </div>
                <div class="icon">
                    <i class="fa-sharp fa-solid fa-building-columns"></i>
                    <label>Net Banking</label>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-backward"></i>
                    <label>UPI</label>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-wallet"></i>
                    <label>Wallets</label>
                </div>
            </div>
        </div>
        <div style="text-align:center">
            <button type="submit">Submit</button>
        </div>
    </form>

</body>

</html>