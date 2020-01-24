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
         <div class="d-flex flex-wrap">
            <?php
               $images = array("banana", "bike", "bottles", "laptop", "dog");
               foreach ($images as $image) {
                  echo "<div class='m-1 p-2 w-25 border rounded'><img src='$image.png' class='img-fluid'><button class='btn btn-block' onclick='addToCart($image)'>Add to cart</button></div>";
               }
            ?>
</div>
   </body>
</html>