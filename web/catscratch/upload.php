<?php

   session_start();

   $path = "img/";

   if ($_SESSION["dq4r1"] == "") {
      $path += "unknown/";
   } else {
      $path += $_SESSION["dq4r1"] . "/";
   }

   // Check if the path exists. If not, create it
   if (!is_dir($path)) {
      mkdir($path);
   }

   $filename = basename($_FILES["file"]["name"]);

   $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));

   $uploadOk = true;

   // Check if the file is an image
   if (isset($_POST["submit"])) {
      $check = getimagesize($_FILES["file"]["tmp_name"]);
      if ($check === false) {
         $uploadOk = false;
         echo "File not an image.";
      }
   }

   // Check if the file is a correct file type
   if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
   && $imageFileType != "gif") {
      echo "Wrong file type.";
      $uploadOk = false;
   }


   if ($uploadOk) {
      if (move_uploaded_file($_FILES["file"]["tmp_name"], $path)) {
         echo "File upload successful!";
      } else {
         echo "There was an error uploading the file."
      }
   } else {
      echo "The file was not uploaded.";
   }
   

?>