// Function to add a product to the cart
function addToCart() {
    // Get product information
    var productName = "Red Printed T-Shirt";
    var productPrice = 50.00;

    // Create a new cart item
    var cartItem = document.createElement("div");
    cartItem.className = "cart-info";
    cartItem.innerHTML = `
        <img src="images/buy-1.jpg">
        <div>
            <p>${productName}</p>
            <small>Price: RM${productPrice.toFixed(2)}</small>
            <br>
            <a href="#" onclick="removeFromCart(this)">Remove</a>
        </div>
    `;

    // Create an input for quantity
    var quantityInput = document.createElement("input");
    quantityInput.type = "number";
    quantityInput.value = 1;
    cartItem.appendChild(quantityInput);

    // Create a subtotal element
    var subtotal = document.createElement("div");
    subtotal.innerHTML = `RM${productPrice.toFixed(2)}`;
    cartItem.appendChild(subtotal);

    // Add the cart item to the cart table
    var cartTable = document.querySelector(".cart-page table");
    var newRow = cartTable.insertRow(cartTable.rows.length);
    var cell1 = newRow.insertCell(0);
    var cell2 = newRow.insertCell(1);
    var cell3 = newRow.insertCell(2);
    cell1.appendChild(cartItem);
    cell2.appendChild(quantityInput);
    cell3.appendChild(subtotal);

    // Calculate and update the total price
    updateTotalPrice();

    // Prevent the default form submission
    return false;
}

// Function to remove a product from the cart
function removeFromCart(linkElement) {
    var row = linkElement.closest("tr");
    row.remove();

    // Recalculate and update the total price
    updateTotalPrice();
}

// Function to update the total price
function updateTotalPrice() {
    var cartTable = document.querySelector(".cart-page table");
    var rows = cartTable.rows;
    var totalPrice = 0;

    for (var i = 1; i < rows.length; i++) {
        var priceCell = rows[i].cells[2].getElementsByTagName("div")[0];
        var quantityInput = rows[i].cells[1].getElementsByTagName("input")[0];
        var productPrice = parseFloat(priceCell.innerHTML.replace("RM", ""));
        var productQuantity = parseInt(quantityInput.value);

        totalPrice += productPrice * productQuantity;
    }

    var subtotalCell = document.querySelector(".total-price table tr:nth-child(1) td:last-child");
    var taxCell = document.querySelector(".total-price table tr:nth-child(2) td:last-child");
    var totalCell = document.querySelector(".total-price table tr:nth-child(3) td:last-child");

    subtotalCell.textContent = `RM${totalPrice.toFixed(2)}`;
    // You can calculate tax based on your business logic
    // For now, let's assume it's 10% of the subtotal
    var taxAmount = totalPrice * 0.1;
    taxCell.textContent = `RM${taxAmount.toFixed(2)}`;
    totalCell.textContent = `RM${(totalPrice + taxAmount).toFixed(2)}`;
}

// Attach the addToCart function to the "Add to Cart" button
var addToCartButton = document.querySelector(".btn-add-to-cart");
if (addToCartButton) {
    addToCartButton.addEventListener("click", addToCart);
}
