<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://kit.fontawesome.com/1b2f4972b7.js" crossorigin="anonymous"></script>
    <script src="js/script2.js"></script>
    <script src="js/script.js"></script>
    <title>Small Basket | Vegetables</title>
</head>

<body>

    <header>
        <div id="menu-bar" class="fa fa-bars"></div>
        <a href="#" class="logo"><i class="fa-sharp fa-solid fa-basket-shopping"></i>&nbsp; SMALL BASKET</i></a>
        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="fruit.php">FRUITS</a>
            <a style="color: #9F9F9F " href="veggies.php">VEGETABLES</a>
            <a href="exotics.php">EXOTICS</a>
            <a href="dairy.php">DAIRY</a>
        </nav>
        <div class="icons">
            <a href="#"><i class="fa fa-heart"></i></a>
            <a href="#" class="cart-icon">
                <i class="fa fa-shopping-cart"></i>
                <span class="cart-count">0</span>
            </a>
            <div class="cart-preview">
                <ul class="cart-items">
                    <!-- Cart items will be here -->
                </ul>
                <p class="total">Total: ₹ 0.00</p>
                <button class="checkout">Checkout</button>
            </div>

            <?php
            session_start();
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

    <br><br><br>

    <section class="product" id="product">
        <h1 class="heading">VEGETABLES <span></span></h1>
        <div class="box-container">



            <?php
            // Connect to database
            $servername = "localhost:3306";
            $username = "root";
            $password = "";
            $dbname = "farmbasket";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve product data from database
            $sql = "SELECT * FROM products WHERE description = 'vege'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Display product data in HTML
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="box">';
                    echo '<div class="content">';
                    echo '<img src="' . $row["image"] . '" alt="' . $row["name"] . '">';
                    echo '<h3>' . $row["name"] . '</h3>';
                    echo '<div class="price">' . $row["price"] . '</div>';
                    echo '<button class="btn" onclick="addToCart(this)">Add to Cart</button>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No products found.";
            }

            // Close database connection
            $conn->close();
            ?>


        </div>
        <script>
            function addToCart(button) {
                button.innerHTML = 'Added';
                setTimeout(function () {
                    button.innerHTML = 'Add to Cart';
                }, 500);
            }
        </script>
    </section>


    <footer class="footer-distributed">

        <div class="footer-left">

            <i class="fa-sharp fa-solid fa-basket-shopping">&nbsp; SMALL BASKET</i>

            <p class="footer-links">
                <a href="index.php" class="link-1">Home</a>
                <a href="fruit.php">Fruits</a>
                <a href="veggies.php">Vegetables</a>
                <a href="exotics.php">Exotic</a>
                <a href="dairy.php">Dairy</a>
            </p>

            <p class="footer-company-name">SMALL BASKET © 2023</p>
        </div>

        <div class="footer-center">

            <div>
                <i class="fa fa-map-marker"></i>
                <p><span>PATNA,</span> BIHAR</p>
            </div>

            <div>
                <i class="fa fa-phone"></i>
                <p>+91 14115185 </p>
            </div>

            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="mailto:care@smallbasket.com">care@smallbasket.com</a></p>
            </div>

        </div>

        <div class="footer-right">

            <p class="footer-company-about">
                <span>About the company</span>
                Delivering from from Farm to your House
            </p>

            <div class="footer-icons">

                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-youtube"></i></a>

            </div>

        </div>

    </footer>

    <script>
        const cartBtns = document.querySelectorAll('.btn');
        let cartItems = [];

        cartBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const product = btn.parentElement;
                const imgSrc = product.querySelector('img').getAttribute('src');
                const title = product.querySelector('h3').textContent;
                const price = product.querySelector('.price').textContent;
                let cartItem = cartItems.find(item => item.title === title);
                if (cartItem) {
                    cartItem.qty++;
                } else {
                    cartItem = {
                        img: imgSrc,
                        title: title,
                        price: price,
                        qty: 1 // set initial quantity to 1
                    };
                    cartItems.push(cartItem);
                }
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
                updateCart();
            });
        });

        function updateCart() {
            const cartCount = document.querySelector('.cart-count');
            const cartPreview = document.querySelector('.cart-preview');
            const cartItemsList = document.querySelector('.cart-items');
            let total = 0;
            cartItemsList.innerHTML = '';
            cartItems.forEach(item => {
                const li = document.createElement('li');
                li.innerHTML = `
            <img src="${item.img}" alt="">
            <div>
                <h4>${item.title}</h4>
                <p>${item.price}</p>
                <div class="quantity">
                    <button class="qty-btn minus" data-title="${item.title}">-</button>
                    <span>${item.qty}</span>
                    <button class="qty-btn plus" data-title="${item.title}">+</button>
                </div>
            </div>
            <i class="fa fa-times-circle remove" data-title="${item.title}"></i>
        `;
                cartItemsList.appendChild(li);
                total += parseInt(item.price.slice(0)) * item.qty;
            });
            cartCount.textContent = cartItems.length;
            document.querySelector('.total').textContent = `Total: ₹${total}.00`;
            cartPreview.classList.add('show');

            // Add event listeners to quantity buttons
            const qtyBtns = document.querySelectorAll('.qty-btn');
            qtyBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const title = btn.dataset.title;
                    const item = cartItems.find(item => item.title === title);
                    if (btn.classList.contains('plus')) {
                        item.qty++;
                    } else if (btn.classList.contains('minus')) {
                        item.qty--;
                        if (item.qty < 1) item.qty = 1;
                    }
                    localStorage.setItem('cartItems', JSON.stringify(cartItems));
                    updateCart();
                });
            });

            // Add event listener to remove button
            const removeBtns = document.querySelectorAll('.remove');
            removeBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const title = btn.dataset.title;
                    cartItems = cartItems.filter(item => item.title !== title);
                    localStorage.setItem('cartItems', JSON.stringify(cartItems));
                    updateCart();
                });
            });
        }

        window.onload = () => {
            if (localStorage.getItem('cartItems')) {
                cartItems = JSON.parse(localStorage.getItem('cartItems'));
                updateCart();
            }
        };

    </script>



</body>

</html>