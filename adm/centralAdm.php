<?php 
$tela=null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $tela = isset($_POST['acao']) ? $_POST['acao'] : '';
    
    
    
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>central do administrador</title>
    <link rel="stylesheet" href="../css/centralAdm.css">
</head>
<body>
<header>
    <div><h1>central do administrador</h1></div>
<div>
    <form  action="" method="post">
        <input type="submit" value="usuarios">
        <input type="hidden" name="acao" value="usuario">
    </form>
    <form  action="" method="post">
        <input type="submit" value="jogo">
        <input type="hidden" name="acao" value="jogo">
    </form>
</div>
</header>
    <main>
        <a href="../index.php">voltar</a>
<?php

switch ($tela) {
    case 'usuario':?>
  
  <section class="usuario">

  </section>


  <?php break;
   case 'jogo':?>

<section class="jogo">

</section>

    <?php break;

    default:
     
}
?>
    
    </main>
</body>
</html>
