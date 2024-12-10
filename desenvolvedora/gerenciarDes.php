<?PHP
session_start();
include_once '../db/config.php';

include_once '../class/Desenvolvedora.php';



if (!isset($_SESSION['des'])) {
   header('Location: index.php');
   exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Gerenciamento dos Jogos</title>
</head>
<body>
   
   <header>

   </header>

   <main>
   
   </main>

</body>
</html>