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

// Get form data
$name = $_POST["name"];
$email = $_POST["email"];
$number = $_POST["mobile"];
$password = $_POST["pass"];
$confirm_password = $_POST["pass2"];

// Check if password and confirm password fields match
if ($password !== $confirm_password) {
    $_SESSION['message'] = "Error: Password and confirm password fields do not match";
    header("Location: index.html");
    exit();
}


// Insert data into table
$sql = "INSERT INTO users (name, number, email, password) VALUES ('$name', '$number', '$email', '$password')";

if (mysqli_query($conn, $sql)) {
    // Account created successfully, set session variable
    session_start();
    $_SESSION['message'] = "Account created successfully | Redirecting to Login";

    // Close the database connection
    mysqli_close($conn);

    // Redirect to login page after 3 seconds
    echo "<script>setTimeout(function() {
        window.location.href = 'login.html';
    }, 2000);</script>";
} else {
    // Error occurred, show error message
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


?>

<div id="message">
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>
</div>