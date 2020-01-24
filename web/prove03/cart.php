<?php

   $item-list = json_decode($_POST["itemList"]);
   $total-price = 0;

   foreach($item-list as $item) {
      $img-name = $item->name . ".png";
      $price = $item->price;

      $total-price += floatval($price);

      echo("<div class=''><img src=$img-name class=''><p></p><button class='btn btn-danger btn-block' onclick='removeFromCart($item->name)'>Remove from cart</button></div>");
   }

   echo("<div class='d-flex'><button class='btn float-left btn-primary' onclick='goShopping()'>Continue shopping</button><button class='btn float-right btn-primary' onclick='checkout()'>Checkout</button></div>");

?>