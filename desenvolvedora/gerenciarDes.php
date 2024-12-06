<?PHP
session_start();
include_once './db/config.php';
include_once './class/Administrador.php';
include_once './class/Desenvolvedora.php';

$logado = null;

if (isset($_SESSION['adm'])) {
   $logado = $_SESSION['adm'];

} else if (isset($_SESSION['des'])) {
   $logado = $_SESSION['des'];
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
      <button type="button"></button>
   </main>

</body>
</html>