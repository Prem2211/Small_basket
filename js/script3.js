const continueButton = document.querySelector('#continue');

continueButton.addEventListener('click', () => {
  const cartItems = JSON.parse(localStorage.getItem('cartItems'));

  const data = {
    items: cartItems,
    total: document.querySelector('.total').textContent
  };

  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'process_order.php', true);
  xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
  xhr.onreadystatechange = function() {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      console.log('Order processed successfully.');
    }
  };
  xhr.send(JSON.stringify(data));
});
