<?php
   require("dbConnect.php");
   $db = get_db();
   
   session_start();
   if ($_SESSION["dq4r1"] == "") {
      // Not logged in
      echo "not logged in";
   } else {
      echo $_SESSION["dq4r1"] . "<br>";

      // Get the username
      $query = "SELECT username FROM users WHERE id=:id LIMIT 1;";

      $stmt = $db->prepare($query);
      $stmt->bindValue(":id", $_SESSION["dq4r1"], PDO::PARAM_INT);
      $stmt->execute();

      $username = $stmt->fetchAll(PDO::FETCH_ASSOC);

      echo json_encode($username) . "</br>";

      // Get the ids of any cats associated with the user id
      $query = "SELECT id, cat_name FROM cats WHERE owner_id=:id;";

      $stmt = $db->prepare($query);
      $stmt->bindValue(":id", $_SESSION["dq4r1"], PDO::PARAM_INT);
      $stmt->execute();

      $cats = $stmt->fetchAll(PDO::FETCH_ASSOC);

      echo json_encode($cats);

      // Get the pictures associated with each of the cats
      $query = "SELECT image_name, cat_id FROM pictures WHERE cat_id=:id;";
      $stmt = $db->prepare($query);
      $pictures = array();
      
      foreach ($cats as $cat) {
         $stmt->bindValue(":id", $cat["id"], PDO::PARAM_INT);
         $stmt->execute();
         array_push($pictures, $stmt->fetchAll(PDO::FETCH_ASSOC));
      }

      echo json_encode($pictures);

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
   <!--
      <div id="add-image" class="w-75 mx-auto border rounded">
      <input type="file" name="image" id="image" accept="image/*">
      <button type="button" onclick="uploadImg()">Upload</button>
   -->
   </div>
   <div id="image-box" class="d-flex flex-wrap w-75 mx-auto border rounded">
      <?php
         foreach ($pictures as $picture) {
            $image = $picture[0]["image_name"];
            $cat_name = getCatName($picture[0]["cat_id"]);
            echo "<div class='border rounded w-25 mx-auto mb-3'>" .
                 "<h3 class='text-center'>$cat_name</h3>" .
                 "<img src='$image' class='img-fluid'>" .
                 "</div>";
         }
      ?>
   </div>
</body>
</html>