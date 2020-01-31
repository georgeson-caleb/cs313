<?php 
   function get_db() {
      $db = null;

      try {
         // Receive the url for Heroku
         $dbUrl = getenv('DATABASE_URL');

         // Separate the parts of the url
         $dbUrlParts = parse_url($dbUrl);

         $dbHost = $dbUrlParts["host"];
         $dbPort = $dbUrlParts["port"];
         $dbUser = $dbUrlParts["user"];
         $dbPassword = $dbUrlParts["pass"];
         $dbName = ltrim($dbUrlParts["pasth"], '/');

         // Create the PDO Connection
         $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbName=$dbName", $dbUser, $dbPassword);

         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
      }
      catch (PDOException $ex) {
         echo "Connection error.";
         die();
      }

      return $db;
   }
?>