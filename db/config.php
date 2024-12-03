<?php
   ini_set('display_errors', 0);
   @include_once '../class/database.php'; 
   @include_once './class/database.php';
   $database = new Database(); 
   $db = $database->getConnection();
?> 