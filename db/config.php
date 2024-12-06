<?PHP
   @include_once '../class/Database.php'; 
   @include_once './class/Database.php';
   $database = new Database(); 
   $db = $database->getConnection();
?>