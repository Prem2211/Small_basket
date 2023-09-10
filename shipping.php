<?php
session_start();
if (isset($_SESSION['name'])) {
    // Database connection
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
    $sql = "SELECT  email, number FROM users WHERE name = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row["email"];
        $mobile = $row["number"];
    } else {
        // Handle error if user data not found

    }

    // Close database connection
    $conn->close();
} else {
    // Redirect user to login page if not logged in
    header("Location: login.php");
    exit();
}
?>





<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/stylec.css">
</head>


<div class="container">
    <h1>Shipping</h1>
    <p>Please enter your shipping details.</p>
    <hr>
    <form class="form" method="post" action="payment.php">
        <div class="form">
            <div class="field">
                <label class="field">
                    <span class="field__label" for="firstname">Name</span>
                    <input class="field__input" type="text" id="firstname" name="firstname"
                        value="<?php echo $username ?>" required />
                </label>
            </div>
            <div class="field">
                <label class="field">
                    <span class="field__label" for="number">Mobile No.</span>
                    <input class="field__input" type="text" id="number" name="number" value="<?php echo $mobile ?>"
                        required />

                </label>
            </div>
            <label class="field">
                <span class="field__label" for="address">Address</span>
                <input class="field__input" type="text" id="address" name="address" / required>
            </label>
            <label class="field">
                <span class="field__label" for="country">Country</span>
                <input class="field__input" type="text" id="country" name="country" value="India" readonly />
            </label>
            <div class="fields fields--3">
                <label class="field">
                    <span class="field__label" for="zipcode">Pin code</span>
                    <input class="field__input" type="number" id="zipcode" name="zipcode" min="100000" max="999999"
                        title="Enter a Valid Pin Code" required />

                </label>
                <label class="field">
                    <span class="field__label" for="city">City</span>
                    <input class="field__input" type="text" id="city" name="city" pattern="[A-Za-z].+[ A-Za-z]"
                        title="Name should only contain alphabets" required />
                </label>
                <label class="field">
                    <span class="field__label" for="state">State</span>
                    <select name="state" id="state">
                        <option value="">Select State</option>
                        <?php
                        $states = array(
                            'Andhra Pradesh',
                            'Arunachal Pradesh',
                            'Assam',
                            'Bihar',
                            'Chhattisgarh',
                            'Goa',
                            'Gujarat',
                            'Haryana',
                            'Himachal Pradesh',
                            'Jharkhand',
                            'Karnataka',
                            'Kerala',
                            'Madhya Pradesh',
                            'Maharashtra',
                            'Manipur',
                            'Meghalaya',
                            'Mizoram',
                            'Nagaland',
                            'Odisha',
                            'Punjab',
                            'Rajasthan',
                            'Sikkim',
                            'Tamil Nadu',
                            'Telangana',
                            'Tripura',
                            'Uttar Pradesh',
                            'Uttarakhand',
                            'West Bengal'
                        );
                        foreach ($states as $state) {
                            echo '<option value="' . $state . '">' . $state . '</option>';
                        }
                        ?>
                    </select>
                </label>
                <input type="hidden" name="cartItems" id="cartItems">
                <input type="hidden" name="email" id="email" value="<?php echo $email ?>">
            </div>
        </div>
        <button type="submit" name="submit" class="button">Continue</button>
    </form>

    <hr>

</div>

<script>
    // retrieve the cartItems data from local storage
    var cartItems = localStorage.getItem('cartItems');

    // set the value of the "cartItems" input field to the JSON string
    document.getElementById('cartItems').value = cartItems;
</script>

</html>