<!DOCTYPE html>
<html>
   <head>
      <title>Misc. Stuff For Sale</title>
      <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
      <script src="script.js"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="stylesheet" href="style.css">
      <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
   <body>
      <header class="jumbotron">
         <h1>
            Miscellaneous Stuff For Sale
</h1>
</header>
         <div id="information" class="d-flex flex-wrap mx-auto w-75">
            <?php
               $images = array("Bananas", "Bike", "Bottles", "Laptop", "Dog");
               $prices = array(
                  "Bananas" => "1.98",
                  "Bike" => "245",
                  "Bottles" => "3.50",
                  "Laptop" => "499",
                  "Dog" => "299"
               );
               foreach ($images as $image) {
                  $price = $prices[$image];
                  echo "<div id='$image' class='m-1 p-2 w-50 border rounded'><img src='$image.png' class='img-fluid'><p>$image </br> $$price</p><button id=\"$image" . "Button\" class='btn btn-block btn-primary' onclick='addToCart(\"$image\", $price)'>Add to cart</button></div>";
               }
            ?>
         <button class="btn btn-block btn-success" onclick="goToCart()">Go to Cart</button>
</div>
   </body>
</html>