<?php
   ini_set('display_errors', 0)
   @include_once '../db/Database.php'; 
   @include_once './db/Database.php';
   $database = new Database(); 
   $db = $database->getConnection();
?> 