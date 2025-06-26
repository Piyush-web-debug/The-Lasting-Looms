document.addEventListener('DOMContentLoaded', function() {
    const cartItemsContainer = document.getElementById('cart-items');
    const totalItemsElement = document.getElementById('total-items');
    const totalPriceElement = document.getElementById('total-price');
    const subtotalElement = document.getElementById('subtotal');
    const cart = JSON.parse(localStorage.getItem('cart')) || [];

    function updateCartSummary() {
        let totalItems = 0;
        let totalPrice = 0;
        cart.forEach(item => {
            totalItems += item.quantity;
            totalPrice += item.price * item.quantity;
        });
        totalItemsElement.textContent = totalItems;
        subtotalElement.textContent = `₹${totalPrice.toFixed(2)}`;
        const shippingCost = 50.00;
        const finalTotalPrice = totalPrice + shippingCost;
        totalPriceElement.textContent = finalTotalPrice.toFixed(2);
    }

    function updateCartItemQuantity(itemId, newQuantity) {
        const item = cart.find(cartItem => cartItem.id === itemId);
        if (item) {
            item.quantity = newQuantity;
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartSummary();
        }
    }

    function removeCartItem(itemId) {
        const itemIndex = cart.findIndex(cartItem => cartItem.id === itemId);
        if (itemIndex > -1) {
            cart.splice(itemIndex, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            renderCartItems();
            updateCartSummary();
        }
    }

    function renderCartItems() {
        cartItemsContainer.innerHTML = '';
        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '<p class="empty-cart-message">Your cart is empty.</p>';
        } else {
            cart.forEach(item => {
                const cartItem = document.createElement('div');
                cartItem.classList.add('cart-item', 'd-flex', 'align-items-center', 'mb-3');
                cartItem.innerHTML = `
                    <img src="${item.image}" alt="${item.name}" class="img-fluid" style="width: 80px; height: 80px; object-fit: cover; margin-right: 10px;">
                    <div>
                        <h5>${item.name}</h5>
                        <p>Quantity: ${item.quantity}</p>
                        <p>Price: ₹${item.price.toFixed(2)}</p>
                        <div class="quantity-controls">
                        <button class="minus-btn">-</button>
                            <input type="number" value="${item.quantity}" min="1" class="quantity-input">
                            <button class="plus-btn">+</button>
                        </div>
                        <button class="remove-button">Remove</button>
                    </div>
                `;
                cartItemsContainer.appendChild(cartItem);

                const minusButton = cartItem.querySelector('.minus-btn');
                const plusButton = cartItem.querySelector('.plus-btn');
                const quantityInput = cartItem.querySelector('.quantity-input');
                const removeButton = cartItem.querySelector('.remove-button');

                minusButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    if (quantityInput.value > 1) {
                        quantityInput.value--;
                        updateCartItemQuantity(item.id, parseInt(quantityInput.value));
                    }
                });

                plusButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    quantityInput.value++;
                    updateCartItemQuantity(item.id, parseInt(quantityInput.value));
                });

                quantityInput.addEventListener('change', function() {
                    if (this.value < 1) {
                        this.value = 1;
                    }
                    updateCartItemQuantity(item.id, parseInt(this.value));
                });

                removeButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    removeCartItem(item.id);
                });
            });
        }
    }

    renderCartItems();
    updateCartSummary();
});

function addToCart(id, name, price, image) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    const existingItem = cart.find(item => item.id === id);
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            id: id,
            name: name,
            price: parseFloat(price),
            image: image,
            quantity: 1
        });
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartDisplay();
}

function updateCartDisplay() {
    const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
    let total = 0;
    cartItems.forEach(item => {
        total += item.price * item.quantity;
    });
    
    // Update cart count
    if (document.getElementById('cart-count')) {
        document.getElementById('cart-count').textContent = cartItems.length;
    }
    
    // Update total if on cart page
    if (document.getElementById('total-price')) {
        document.getElementById('total-price').textContent = total.toFixed(2);
    }
}

// Initialize cart display when page loads
document.addEventListener('DOMContentLoaded', updateCartDisplay);
