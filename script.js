// Get the cart button and the cart section
const cartBtn = document.querySelector(".cartbtn");
const cartSection = document.querySelector(".cart-section");

// Add an event listener to the cart button
cartBtn.addEventListener("click", () => {
  cartSection.classList.toggle("show");
});

// Get the cart section and its position
let pos1 = 0,
  pos2 = 0,
  pos3 = 0,
  pos4 = 0,
  speed = 1;

// Add a mousedown event listener to the cart section
cartSection.addEventListener("mousedown", dragMouseDown);

/* DRAGGABLE SHOPPING CART */
function dragMouseDown(e) {
  e.preventDefault();
  // Get the current mouse position
  pos3 = e.clientX;
  pos4 = e.clientY;
  // Add a mousemove event listener to the document
  document.addEventListener("mousemove", elementDrag);
  // Add a mouseup event listener to the document
  document.addEventListener("mouseup", stopElementDrag);
}

function elementDrag(e) {
  e.preventDefault();
  // Calculate the new mouse position and movement distance
  pos1 = pos3 - e.clientX;
  pos2 = pos4 - e.clientY;
  pos3 = e.clientX;
  pos4 = e.clientY;
  // Calculate the new position of the cart-section
  let movementX = Math.abs(e.movementX);
  let movementY = Math.abs(e.movementY);
  let newX = cartSection.offsetLeft - pos1 * movementX * speed;
  let newY = cartSection.offsetTop - pos2 * movementY * speed;
  // Get the width and height of the window
  let windowWidth = window.innerWidth;
  let windowHeight = window.innerHeight;
  // Get the width and height of the cart-section
  let cartWidth = cartSection.offsetWidth;
  let cartHeight = cartSection.offsetHeight;
  // Check if the cart-section goes outside the bounds of the screen
  if (newX < 0) {
    newX = 0;
  }
  if (newY < 0) {
    newY = 0;
  }
  if (newX + cartWidth > windowWidth) {
    newX = windowWidth - cartWidth;
  }
  if (newY + cartHeight > windowHeight) {
    newY = windowHeight - cartHeight;
  }
  // Set the element's new position
  cartSection.style.top = newY + "px";
  cartSection.style.left = newX + "px";
}

function stopElementDrag() {
  // Remove the mousemove and mouseup event listeners from the document
  document.removeEventListener("mousemove", elementDrag);
  document.removeEventListener("mouseup", stopElementDrag);
}


/* Refresh and format iframe */
function adjustDivHeight() {
  var iframe = document.getElementById('shopping-cart');
  var div = document.querySelector('.table-container');
  div.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
}

function clearCart() {
  if (confirm('Are you sure you want to clear the cart?')) {
    // Make an AJAX request to clear the cart
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'clear_cart.php', true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Refresh the iframe after clearing the cart
        refreshIframe();
      }
    };
    xhr.send();
  }
}

/* CART FUNCTIONALITY */
function addToCart(itemId) {
  var add_to_cart_btn = document.getElementById("add-to-cart-" + itemId);
  if (add_to_cart_btn.classList.contains("disabled")) return  //when disabled don't do anything

  var item_id = add_to_cart_btn.getAttribute("data-item-id");
  var item_price = add_to_cart_btn.getAttribute("data-item-price");
  var item_stock = add_to_cart_btn.getAttribute("data-item-stock");

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      add_to_cart_btn.classList.add("disabled");
      add_to_cart_btn.innerText = "Added to Cart";
    }
  };
  xmlhttp.open("GET", "add_to_cart.php?item_id=" + item_id + "&item_price=" + item_price + "&item_stock=" + item_stock, true);
  xmlhttp.send();
}


 // Get the cart button and iframe elements
 const cartButton = document.getElementById("cart-button");
 const shoppingCart = document.getElementById("shopping-cart");

 // Add an event listener to the cart button
 cartButton.addEventListener("click", function() {
   // Reload the iframe source
   shoppingCart.src = shoppingCart.src;
 });



