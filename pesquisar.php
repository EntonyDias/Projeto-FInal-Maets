<?PHP
session_start();

$logado = null;

if (isset($_SESSION['adm'])) {
   $logado = $_SESSION['adm'];

} else if (isset($_SESSION['usu'])) {
   $logado = $_SESSION['usu'];
   
} else if (isset($_SESSION['des'])) {
   $logado = $_SESSION['adm'];
}

var_dump($logado);

/*
switch($logado)

case "": (!isset($_SESSION['adm'])){
   echo "<button type='button'><a href='login.php'>Logar</a></button>";
   exit;
} else if (!isset($_SESSION['usu'])){
   echo "<button type='button'><a href='login.php'>Logar</a></button>";
   exit;
} else if (!isset($_SESSION['des'])){
   echo "<button type='button'><a href='login.php'>Logar</a></button>";
} */

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