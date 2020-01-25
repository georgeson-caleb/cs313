<?php

   $address = json_decode(strip_tags($_POST["address"]));
   $items = json_decode($_POST["items"]);

   // Confirmation message
   $confirmationMessage = "<h2>Thank you for your order!</h2>";
   // Address
   $confirmationMessage .= "<div id='address' class=''>Your order will be shipped to $address->add1 $address->add2 $address->city, $address->state, $address->zip.</div>";
   // Items purchased
   $confirmationMessage .= "<div id='itemsPurchased' class=''>These items will be shipped to you:<div class='d-flex'>";

   foreach ($items as $item) {
      confirmationMessage .= "<div id='$item->name' class='col-sm-12 col-md-6 col-lg-3'><img src='$item->name.png' class='img-fluid'><p>$item->name</p></div>";
   }

   $confirmationMessage .= "</div></div>";

   echo $confirmationMessage;
?>