<?php

   require("dbConnect.php");

   session_start();

   echo $_SESSION["dq4r1"] . "<br>";
   $path = "img/";

   if ($_SESSION["dq4r1"] == "") {
      $path .= "unknown/";
   } else {
      $path .= $_SESSION["dq4r1"] . "/";
   }

   echo $path . "<br>";

   // Check if the path exists. If not, create it
   if (!is_dir($path)) {
      mkdir($path);
   }
 
   $filename = $path . basename($_FILES["image"]["name"]);

   $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));

   $uploadOk = true;

   // Check if the file is an image
   if (isset($_POST["submit"])) {
      $check = getimagesize($_FILES["image"]["tmp_name"]);
      if ($check === false) {
         $uploadOk = false;
         echo "File not an image.";
      }
   }

   // Check if the file is a correct file type
   if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
   && $imageFileType != "gif") {
      echo "Wrong file type: " . $imageFileType;
      $uploadOk = false;
   }


   if ($uploadOk) {
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $filename)) {

         echo "File upload successful! <img src=$filename class='img-fluid w-25'>";
         $cat_name = strip_tags($_POST["name"]);
         $age = strip_tags($_POST["age"]);
         $db = get_db();
         $query = "INSERT INTO cats (cat_name, age, owner_id) VALUES (:cat_name, :age, :id);";
         $stmt = $db->prepare($query);
         $stmt->bindValue(":cat_name", $cat_name, PDO::PARAM_STR);
         $stmt->bindValue(":age", $age, PDO::PARAM_INT);
         $stmt->bindValue(":id", $_SESSION["dq4r1"], PDO::PARAM_INT);
         $stmt->execute();

         $cat_id = $db->lastInsertId();

         $query = "INSERT INTO pictures (image_name, cat_id) VALUES (:image_name, :cat_id);";
         $stmt = $db->prepare($query);
         $stmt->bindValue(":image_name", $filename, PDO::PARAM_STR);
         $stmt->bindValue(":cat_id", $cat_id, PDO::PARAM_INT);
         $stmt->execute();

      } else {
         echo "There was an error uploading the file.";
      }
   } else {
      echo "The file was not uploaded.";
   }
   

?>