<?php
   require("dbConnect.php");
   include("findKitties.php");
   $db = get_db();
   
   session_start();   

   // Get the username
   $query = "SELECT username FROM users WHERE id=:id LIMIT 1;";

   $stmt = $db->prepare($query);
   $stmt->bindValue(":id", $_SESSION["dq4r1"], PDO::PARAM_INT);
   $stmt->execute();

   $username = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]["username"];

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
   <header id="top" class="d-flex justify-content-between">
   <h1>Catscratch</h1>
   <h4> Welcome, 
   <?php echo $username; ?>
   </h4>
   </header>
   

<?
   if ($_SESSION["dq4r1"] == "") {
      // Not logged in
      ?>
         <div class="mt-2 mx-auto p-2 border rounded">Oops! You're not logged in. Click <a href='index.php'>here</a> to log in.</div>
      <?
   } else {
      showKitties($_SESSION["dq4r1"]);
      
      ?>

      <div class='border rounded w-25 mx-2 mb-3'>
         <a href="add-cat.php"> Click to add a kitty! </a>
      </div>
   </div>

   <?}?>
</body>
</html>