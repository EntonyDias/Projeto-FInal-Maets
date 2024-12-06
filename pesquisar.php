<?PHP
session_start();

include_once "./db/config.php";
include_once "./class/Jogos.php";

$jogosDB = new Jogo($db);

$logado = null;

if (isset($_SESSION['adm'])) {
   $logado = $_SESSION['adm'];

} else if (isset($_SESSION['usu'])) {
   $logado = $_SESSION['usu'];
   
} else if (isset($_SESSION['des'])) {
   $logado = $_SESSION['des'];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $pesquisa = $_POST['txtPesquisa'];
   $jogos = null;

   if ($pesquisa == "" || $pesquisa == " "){
      $jogos = $jogosDB->listarTodos();
   } else {
      $jogos = $jogosDB->pesquisarNome($pesquisa);
   }
}

if (isset($_SESSION['adm'])) {
   echo "<button type='button'><a href='login.php'>Logara</a></button>";

} else if (isset($_SESSION['usu'])) {
   echo "<button type='button'><a href='login.php'>Logaru</a></button>";

} else if (isset($_SESSION['des'])) {
   echo "<button type='button'><a href='login.php'>Logard</a></button>";

} else {echo "<button type='button'><a href='login.php'>Logar</a></button>";}




?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pesquisa</title>
</head>

<body>
   <header>



   </header>

   <main>


   </main>

</body>

</html>