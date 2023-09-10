<?php
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

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];

// Check if email and password are correct
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    // User exists, set the session variable and redirect to the dashboard
    $row = mysqli_fetch_assoc($result);
    $_SESSION['name'] = $row['name'];
    header('Location: index.php');
} else {
    // User doesn't exist or password is incorrect, show error message
    echo "Invalid email or password";
}

mysqli_close($conn);
?>