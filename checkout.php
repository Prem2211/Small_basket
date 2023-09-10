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
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 1rem;
        }

        th,
        td {
            text-align: left;
            padding: 0.5rem;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="number"] {
            width: 4rem;
            text-align: center;
            border: none;
            background-color: #f2f2f2;
            padding: 0.5rem;
        }

        select {
            padding: 0.5rem;
            background-color: #f2f2f2;
            border: none;
            font-size: inherit;
        }

        .total {
            font-size: 1.5rem;
            font-weight: bold;
            margin-top: 1rem;
        }

        .product-img {
            width: 10%;
        }

        .button {
            background-color: #000;
            text-transform: uppercase;
            font-size: 0.8rem;
            font-weight: 600;
            display: block;
            color: #fff;
            width: 100%;
            padding: 1rem;
            border-radius: 0.25rem;
            border: 0;
            cursor: pointer;
            outline: 0;
        }

        .button:focus-visible {
            background-color: #333;
        }
    </style>
    <script src="js/script.js" defer></script>
</head>

<body>
    <a href="fruit.php">
        <h4>Back To Shopping</h4>
    </a>
    <div style="text-align:center;">
        <h1>Checkout</h1>
    </div>

    <h4>
        <?php echo $username ?>
        <br>
        Mobile No- +91 -
        <?php echo $mobile ?>
        <br>
        Email-
        <?php echo $email ?>
    </h4>


    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <!-- Cart items will be here -->
        </tbody>
    </table>
    <p class="total">Total: ₹ 0.00</p>



    <button id="continue-button" class="button" onclick="shipping()">Continue</button>



</body>
<script>
    function shipping() {
        window.location.href = "shipping.php";
    }
    const cartItems = JSON.parse(localStorage.getItem('cartItems'));

    function updateCart() {
        const cartTableBody = document.querySelector('tbody');
        let total = 0;
        cartTableBody.innerHTML = '';
        cartItems.forEach(item => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
      <td>
        <img class="product-img" src="${item.img}" alt="">
        ${item.title}
      </td>
      <td class="item-price">${item.price}</td>
      <td>
        <input type="number" class="item-qty" value="${item.qty}" min="1">
      </td>
      <td class="item-total">${item.price * item.qty}</td>
    `;
            const input = tr.querySelector('input');
            input.addEventListener('input', () => {
                item.qty = input.value;
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
                updateItemTotal(input, item.price);
            });
            cartTableBody.appendChild(tr);
            total += item.price * item.qty;
        });
        document.querySelector('.total').textContent = `Total: ₹${total}.00`;
    }

    function updateItemTotal(input, price) {
        const quantity = input.value;
        const itemTotal = price * quantity;
        input.parentElement.nextElementSibling.textContent = itemTotal;
        updateTotal();
    }

    function updateTotal() {
        const itemTotals = document.querySelectorAll('.item-total');
        let total = 0;
        itemTotals.forEach(itemTotal => {
            total += parseInt(itemTotal.textContent);
        });
        document.querySelector('.total').textContent = `Total: ₹${total}.00`;


    }




    window.onload = () => {
        if (cartItems) {
            updateCart();
        }
    };






</script>



</html>