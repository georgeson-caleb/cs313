<?php

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

   echo json_encode($_FILES);

   $filename = $path . basename($_FILES["image"]["name"]);
   echo $filename . "<br>";

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
      } else {
         echo "There was an error uploading the file.";
      }
   } else {
      echo "The file was not uploaded.";
   }
   

?>