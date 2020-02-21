<?php
   function showCats($userId) {

      // Get the ids of any cats associated with the user id
      $query = "SELECT id, cat_name FROM cats WHERE owner_id=:id;";

      $stmt = $db->prepare($query);
      $stmt->bindValue(":id", $userId, PDO::PARAM_INT);
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
?>

   <h3 class="text-center">Your Cats</h3>
   <div id="info-box" class="d-flex flex-wrap w-75 mx-auto mb-2 p-2 border rounded">
      <?

         if (count($cats) == 0) {
            echo "No cats yet. Add some to see them here!";
         }

         foreach ($pictures as $picture) {
            $image = $picture[0]["image_name"];
            $cat_name = getCatName($picture[0]["cat_id"]);
            ?> 
               <div class='border rounded w-25 mx-2 mb-3'>
                  <h3 class='text-center'>$cat_name</h3>
                  <img src='$image' class='img-fluid'>
               </div>
            <?
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