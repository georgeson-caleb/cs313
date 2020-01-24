class Item {
   name;
   price;
}

var itemList = [];

function addToCart(name, price) {
   var item = new Item();
   item.name = name;
   item.price = price;

   changeButtonToRed(name);

   itemList.push(item);
}

function removeFromCart(name) {
   changeButtonToBlue(name);
}

function goToCart() {
   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         updatePage(this.responseText);
      }
   }

   xhttp.open("POST", "cart.php", true);
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhttp.send("itemList=" + JSON.stringify(itemList));
}

function updatePage(response) {
   document.getElementById("information").innerHTML = response;
}

function changeButtonToRed(name) {
   var button = document.getElementById(name + "Button");
   button.classList.remove("btn-primary");
   button.classList.add("btn-danger");
   button.innerHTML = "Remove from cart";
   button.removeEventListener('onclick', addToCart(name));
   button.addEventListener('onclick', removeFromCart(name));
}

function changeButtonToBlue(name) {
   var button = document.getElementById(name + "Button");
   button.classList.remove("btn-danger");
   button.classList.add("btn-primary");
   button.innerHTML = "Add to cart";
   button.removeEventListener('onclick', removeFromCart(name));
   button.addEventListener('onclick', addToCart(name));
}