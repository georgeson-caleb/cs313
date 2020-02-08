<?php
   require("dbConnect.php");
   $db = get_db();
   
   session_start();
   if ($_SESSION["dq4r1"] == "") {
      // Not logged in
      echo "not logged in";
   } else {

      // Get the username
      $query = "SELECT username FROM users WHERE id=:id LIMIT 1;";

      $stmt = $db->prepare($query);
      $stmt->bindValue(":id", $_SESSION["dq4r1"], PDO::PARAM_INT);
      $stmt->execute();

      $username = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Get the ids of any cats associated with the user id
      $query = "SELECT id, cat_name FROM cats WHERE owner_id=:id;";

      $stmt = $db->prepare($query);
      $stmt->bindValue(":id", $_SESSION["dq4r1"], PDO::PARAM_INT);
      $stmt->execute();

      $cats = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Get the pictures associated with each of the cats
      $query = "SELECT image_name, cat_id FROM pictures WHERE cat_id=:id;";
      $stmt = $db->prepare($query);
      $pictures = array();
      
      foreach ($cats as $cat) {
         $stmt->bindValue(":id", $cat["id"], PDO::PARAM_INT);
         $stmt->execute();
         array_push($pictures, $stmt->fetchAll(PDO::FETCH_ASSOC));
      }
   }

   function getCatName($cat_id) {
      global $db;
      $query = "SELECT cat_name FROM cats WHERE id=:id;";
      $stmt = $db->prepare($query);
      $stmt->bindValue(":id", $cat_id, PDO::PARAM_INT);
      $stmt->execute();

      return $stmt->fetch(PDO::FETCH_ASSOC)["cat_name"];
   }
?>

<!DOCTYPE html>
<html>
<head>
   <title> Catscratch - Share your kitties!</title>
   <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <script src="script.js"></script>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <link rel="stylesheet" href="style.css">
</head>
<body>
   <header id="top">
      <h1>Catscratch</h1>
   </header>
   
   </div>
   <div id="info-box" class="d-flex flex-wrap w-75 mx-auto mb-2 p-2 border rounded">
   <h3 class="text-center">Your Cats</h3>
      <?php

         if (count($cats) == 0) {
            echo "No cats yet. Add some to see them here!";
         }

         foreach ($pictures as $picture) {
            $image = $picture[0]["image_name"];
            $cat_name = getCatName($picture[0]["cat_id"]);
            echo "<div class='border rounded w-25 mx-2 mb-3'>" .
                 "<h3 class='text-center'>$cat_name</h3>" .
                 "<img src='$image' class='img-fluid'>" .
                 "</div>";
         }

      ?>

      <div class='border rounded w-25 mx-2 mb-3' onclick="showAddCatForm()">
         <a href="add-cat.php"> Click to add a kitty! </a>
      </div>
   </div>
</body>
</html>