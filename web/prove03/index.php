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
         <div class="d-flex flex-wrap">
            <?php
               $image = array("banana", "bike", "bottles", "laptop", "dog");
               foreach ($images as $image) {
                  echo "<div><img src='$image.png' class=''></div>";
               }

            ?>
</div>
   </body>
</html>