<?php
// Start the session
session_start();

$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "farmbasket";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the user's information from the database
$name = $_SESSION['name'];
$sql = "SELECT * FROM users WHERE name = '$name'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // User found, display the account information
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $email = $row['email'];
    $mobile = $row['number'];
} else {
    // User not found
    echo "Error: User not found";
    exit();

}

// Close the database connection
mysqli_close($conn);
?>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://kit.fontawesome.com/1b2f4972b7.js" crossorigin="anonymous"></script>
    <script src="js/script2.js"></script>
    <script src="js/script.js"></script>
    <title>Small Basket | Account</title>
</head>

<body>

    <header>
        <div id="menu-bar" class="fa fa-bars"></div>
        <a href="#" class="logo"><i class="fa-sharp fa-solid fa-basket-shopping"></i>&nbsp; SMALL BASKET</i></a>
        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="fruit.php">FRUITS</a>
            <a href="veggies.php">VEGETABLES</a>
            <a href="exotics.php">EXOTICS</a>
            <a href="dairy.php">DAIRY</a>
        </nav>


        <?php

        if (isset($_SESSION['name'])) {
            echo '<div class="dropdown">
            <button class="dropbtn">Welcome, ' . $_SESSION['name'] . ' ▼</button>
            <div class="dropdown-content">
                <a href="account.php">My Account</a>
                <a href="orders.php">My Orders</a>
                <a href="logout.php">Logout </a>
               
            </div>
          </div>';
        } else {
            echo '<div class="login">
                <a href="login.html"><i class="fa fa-user"></i></a>
          </div>';
        }
        ?>
        </div>
    </header>



    <div class="update">
        <h1>My Account</h1>
        <form>
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $name; ?>" readonly><br>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $email; ?>" readonly><br>

            <label>Mobile:</label>
            <input type="tel" name="mobile" value="<?php echo $mobile; ?>" readonly><br>
        </form>
    </div>

</body>