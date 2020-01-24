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