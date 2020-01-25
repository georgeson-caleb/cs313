class Item {
   name;
   price;
}

var itemList = [];

function addToCart(name, price) {
   var item = new Item();
   item.name = name;
   item.price = price;

   document.getElementById(name + "Button").disabled = true;

   itemList.push(item);
}

function removeFromCart(name) {
   var elem = document.getElementById(name);
   elem.parentElement.removeChild(elem);
   for (var i = 0; i < itemList.length; i++) {
      if (itemList[i].name == name) {
         itemList.splice(i, 1);
      }
   }
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

function goShopping() {
   location.reload();
}

function checkout() {
   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         updatePage(this.responseText);
      }
   }

   xhttp.open("POST", "checkout.php", true);
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhttp.send();
}

function confirmPurchase() {
   // Check the user's input
   var valid = true;
   var elemList = [];
   elemList.push(document.getElementById("addressLine1"));
   elemList.push(document.getElementById("addressLine2"));
   elemList.push(document.getElementById("city"));
   elemList.push(document.getElementById("state"));
   elemList.push(document.getElementById("zip"));

   for (var i = 0; i < elemList.length; i++) {
      // Address Line 2 is not required
      if (i != 1) {
         if (elemList[i].value != "") {
            // valid stays true unless it has already been set to false
            valid = valid & true;
         } else {
            // Set valid to false
            valid = false;
            // Show that the box is invalid
            elemList[i].classList.add("border border-danger");
         }
      }

      if (valid) {
         //Go to confirmation page
      } else {
         // Show invalid message
         document.getElementById("invalid-message").classList.remove("d-none");
      }
   }
   
}