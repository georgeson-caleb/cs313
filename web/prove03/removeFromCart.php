<?php

   $index = array_search($_POST["item"], $_SESSION["cart"]);
   array_splice($_SESSION["cart"], $index);

?>