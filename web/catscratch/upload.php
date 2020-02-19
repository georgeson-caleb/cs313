<?php

   require("dbConnect.php");
   require('../../vendor/autoload.php');

   $s3 = new Aws\S3\S3Client([
   'version' => '2006-03-01',
   'region'  => 'us-west-2'
   ]);

   session_start();

   $path = "img/";

   if ($_SESSION["dq4r1"] == "") {
      $path .= "unknown/";
   } else {
      $path .= $_SESSION["dq4r1"] . "/";
   }

   // Check if the path exists. If not, create it
   if (!is_dir($path)) {
      mkdir($path);
   }

   $imageFileType = strtolower(pathinfo($_FILES["image"]["tmp_name"],PATHINFO_EXTENSION));

   echo $imageFileType;
 
   // Create a unique filename based on the current time
   $filename = $path . time() . $imageFileType;

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

      $bucket = getenv('S3_BUCKET')? : die("Couldn't get the bucket");
      
      try {
         $upload = $s3->upload($bucket, $filename, fopen($_FILES["image"]["tmp_name"], 'rb'), 'public-read'); 
      } catch(Exception $e) {
         echo "Error uploading file";
         die();
      }

      $cat_name = strip_tags($_POST["name"]);
      $fav_food = strip_tags($_POST["food"]);
      $fav_pastime = strip_tags($_POST["pastime"]);
      $age = strip_tags($_POST["age"]);
      $db = get_db();
      $query = "INSERT INTO cats (cat_name, fav_food, fav_pastime, age, owner_id) VALUES (:cat_name, :fav_food, :fav_pastime, :age, :id);";
      $stmt = $db->prepare($query);
      $stmt->bindValue(":cat_name", $cat_name, PDO::PARAM_STR);
      $stmt->bindValue(":fav_food", $fav_food, PDO::PARAM_STR);
      $stmt->bindValue(":fav_pastime", $fav_pastime, PDO::PARAM_STR);
      $stmt->bindValue(":age", $age, PDO::PARAM_INT);
      $stmt->bindValue(":id", $_SESSION["dq4r1"], PDO::PARAM_INT);
      $stmt->execute();

      $cat_id = $db->lastInsertId();

      $query = "INSERT INTO pictures (image_name, cat_id) VALUES (:image_name, :cat_id);";
      $stmt = $db->prepare($query);
      $stmt->bindValue(":image_name", $upload->get("ObjectURL"), PDO::PARAM_STR);
      $stmt->bindValue(":cat_id", $cat_id, PDO::PARAM_INT);
      $stmt->execute();

   } else {
      echo "The file was not uploaded.";
   }
   

?>