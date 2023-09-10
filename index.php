<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://kit.fontawesome.com/1b2f4972b7.js" crossorigin="anonymous"></script>
    <script src="js/script2.js"></script>
    <script src="js/script.js"></script>
    <title>Small Basket | Home</title>
</head>

<body>

    <header>
        <div id="menu-bar" class="fa fa-bars"></div>
        <a href="#" class="logo"><i class="fa-sharp fa-solid fa-basket-shopping"></i>&nbsp; SMALL BASKET</i></a>
        <nav class="navbar">
            <a href="#home">Home</a>
            <a href="fruit.php">FRUITS</a>
            <a href="veggies.php">VEGETABLES</a>
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




    <section class="home" id="home">
        <div class="slide-container active">
            <div class="slide">
                <div class="content">
                    <span>ORGANIC </span>
                    <h3>FRUITS,VEGGIES & DAIRY PRODUCTS</h3>

                    <br>
                    <p>
                        FRESH FROM FARM TO HOME
                    </p>


                </div>
                <div class="image">
                    <img src="img/4.png" class="shoe">
                </div>
            </div>
        </div>

    </section>



    <script>
        const cartBtns = document.querySelectorAll('.btn');
        let cartItems = [];

        cartBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const product = btn.parentElement;
                const imgSrc = product.querySelector('img').getAttribute('src');
                const title = product.querySelector('h3').textContent;
                const price = product.querySelector('.price').textContent;
                const cartItem = {
                    img: imgSrc,
                    title: title,
                    price: price
                };
                cartItems.push(cartItem);
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
                </div>
                <i class="fa fa-times-circle remove"></i>
            `;
                cartItemsList.appendChild(li);
                total += parseInt(item.price.slice(1));
            });
            cartCount.textContent = cartItems.length;
            document.querySelector('.total').textContent = `Total: ₹${total}.00`;
            cartPreview.classList.add('show');
            const removeBtns = document.querySelectorAll('.remove');
            removeBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const li = btn.parentElement;
                    const title = li.querySelector('h4').textContent;
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

        // Add the new products to the cart
        const newProducts = [
            {
                img: "https://via.placeholder.com/150",
                title: "New Product 1",
                price: "₹50.00"
            },
            {
                img: "https://via.placeholder.com/150",
                title: "New Product 2",
                price: "₹75.00"
            },
            {
                img: "https://via.placeholder.com/150",
                title: "New Product 3",
                price: "₹100.00"
            }
        ];

        const addToCartBtns = document.querySelectorAll('.add-to-cart');
        addToCartBtns.forEach((btn, index) => {
            btn.addEventListener('click', () => {
                const newProduct = newProducts[index];
                cartItems.push(newProduct);
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
                updateCart();
            });
        });
    </script>

</body>

</html>