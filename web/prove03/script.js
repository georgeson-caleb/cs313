class Item {
   name;
   price;
}

var itemList = [];

function addToCart(name, price) {
   var item = new Item();
   item.name = name;
   item.price = price;

   itemList.push(item);
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
   Document.getElementById("information").innerHTML = response;
}