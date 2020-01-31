<?php 
   function get_db() {
      $db = null;

      try {
         // Receive the url for Heroku
         $dbUrl = getenv('DATABASE_URL');
         echo $dbUrl;

         // Separate the parts of the url
         $dbUrlParts = parse_url($dbUrl);

         $dbHost = $dbUrlParts["host"];
         $dbPort = $dbUrlParts["port"];
         $dbUser = $dbUrlParts["user"];
         $dbPassword = $dbUrlParts["pass"];
         $dbName = ltrim($dbUrlParts["path"], '/');

         // Create the PDO Connection
         $db = new PDO("pgsql:host=$dbHost;port=$dbPort;", $dbUser, $dbPassword);

         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
      }
      catch (PDOException $ex) {
         echo "Connection error. $ex";
         die();
      }

      return $db;
   }
?>