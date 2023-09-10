document.addEventListener('DOMContentLoaded', () => {
    const cartIcon = document.querySelector('.cart-icon');
    const cartPreview = document.querySelector('.cart-preview');
    const cartItems = document.querySelector('.cart-items');
    const cartCount = document.querySelector('.cart-count');
    const total = document.querySelector('.total');
    const checkoutButton = document.querySelector('.checkout');
const cartPreviewContainer = document.querySelector('#cart-preview-container');
const checkoutBtn = document.querySelector('.checkout');
checkoutBtn.addEventListener('click', () => {
   window.location.href = 'checkout.php'; // Redirect to checkout.html
});



cartIcon.addEventListener('click', function() {
    cartPreviewContainer.classList.toggle('show');
});
  
    let cart = [];
  
    // Add item to cart
    function addToCart(item) {
      cart.push(item);
      updateCartPreview();
    }
    function showCartPreview() {
      let cartPreview = document.querySelector(".cart-preview");
      cartPreview.classList.toggle("show");
  }
  
  
    // Remove item from cart
    function removeFromCart(item) {
      const index = cart.indexOf(item);
      if (index !== -1) {
        cart.splice(index, 1);
        updateCartPreview();
      }
    }
  
    // Update cart preview
    function updateCartPreview() {
      cartCount.textContent = cart.length;
      cartItems.innerHTML = '';
      let cartTotal = 0;
      cart.forEach(item => {
        const li = document.createElement('li');
        li.textContent = item.name + ': ₹' + item.price;
        cartItems.appendChild(li);
        cartTotal += item.price;
      });
      total.textContent = 'Total: ₹' + cartTotal.toFixed(2);
    }
  
    // Event listener for cart icon click
    cartIcon.addEventListener('click', () => {
      cartPreview.classList.toggle('show');
    });
  
    
  });
  // Select the Add to Cart button
const addToCartButton = document.getElementById('add-to-cart');

// Listen to the click event of the Add to Cart button
addToCartButton.addEventListener('click', () => {
  // Get the product information
  const productName = 'Product Name'; // Replace with the actual product name
  const productPrice = 10.99; // Replace with the actual product price

  // Add the product to the cart
  addToCart({ name: productName, price: productPrice });
});

// Function to add a product to the cart
function addToCart(item) {
  // Get the current cart items from localStorage
  let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

  // Check if the product is already in the cart
  const index = cartItems.findIndex(i => i.name === item.name);
  if (index === -1) {
    // Product is not in the cart, add it
    cartItems.push({ ...item, quantity: 1 });
  } else {
    // Product is already in the cart, increase its quantity
    cartItems[index].quantity++;
  }

  // Save the updated cart items to localStorage
  localStorage.setItem('cartItems', JSON.stringify(cartItems));

  // Update the cart count and preview
  updateCartCount();
  updateCartPreview();
  
}
