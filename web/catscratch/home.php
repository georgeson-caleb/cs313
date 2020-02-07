<?php
   require("dbConnect.php");
   $db = get_db();
   /*
   session_start();
   if ($_SESSION["dq4r1"] == "") {
      // Not logged in
   } else {

      // Get the username
      $query = "SELECT username FROM users WHERE id=:id LIMIT 1;";

      $stmt = $db->prepare($query);
      $stmt->bindValues(":id", $_SESSION["dq4r1"], PDO::PARAM_INT);
      $stmt->execute;

      $username = $stmt->fetch(PDO::FETCH_ASSOC)["username"];

      // Get the ids of any cats associated with the user id
      $query = "SELECT id, cat_name FROM cats WHERE owner_id=:id";

      $stmt = $db->prepare($query);
      $stmt->bindValues(":id", $_SESSION["dq4r1"], PDO::PARAM_INT);
      $stmt->execute;

      $cats = $stmt->fetchAll(PDO::FETCH_ASSOC);

      echo json_encode($cats);

      // Get the pictures associated with each of the cats
      $query = "SELECT image_name FROM pictures WHERE cat_id=:id";
      $stmt = $db->prepare($query);
      $pictures = array(1);
      foreach ($cats as $cat) {
         $stmt->bindValues(":id", $cat["id"], PDO::PARAM_INT);
         $stmt->execute();
         array_push($pictures, $stmt->fetchAll(PDO::FETCH_ASSOC));
      }

   }*/
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
   <div id="add-image" class="w-75 mx-auto border rounded">
      <form action="upload.php">
         <input type="file" name="image" accept="image/*">
         <input type="submit" value="Upload Image" name="submit">
      </form>
   </div>
   <div id="image-column" class="w-75 mx-auto">
   </div>
</body>
</html>