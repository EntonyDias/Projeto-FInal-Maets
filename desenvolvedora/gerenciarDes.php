<?PHP
session_start();
include_once '../db/config.php';
include_once '../class/Desenvolvedora.php';
include_once '../class/Administrador.php';
include_once '../class/Jogos.php';

$desenvolvedora = new Desenvolvedora($db);
$jogo = new Jogo($db);


$logado = "null";


//Adm
if (isset($_SESSION['adm'])) {
   $logado = $_SESSION['adm'];

   if (isset($_GET['idDes'])) {
      $dados_des = $desenvolvedora->lerPorId($_GET['idDes']);
   }

   //Des
} else if (isset($_SESSION['des'])) {
   $logado = $_SESSION['des'];
   $dados_des = $desenvolvedora->lerPorId($logado['idDes']);

   //Usu
} else if (isset($_SESSION['usu'])) {
   header('Location: ../index.php');
   exit();
}


$jogosDes = $jogo->listarPorDesenvolvedoraID($dados_des['idDes']);
$jogos = $jogo->ler();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Gerenciar dos Jogos</title>
   <link rel="stylesheet" href="../css/centralDes.css">
</head>

<body>

   <header>
      <button class="logo" href="./gereciarDes.php"><img id="logo" src="../assets/logoTop.png" alt=""></button>

      <h1>Central de Desenvolvedora</h1>
      <div>
         <button class="menu-btn">&#9776;</button>
      </div>
      <div class="menu" id="menu">
         <?php

         switch ($logado) {
            case isset($_SESSION['adm']):
               echo "<a href='../logout.php'>Logout</a>";
               echo "<a href='../adm/centralAdm.php'>Central de Controle</a>";
               echo "<a href='./addJogo.php?idDes=" . $dados_des['idDes'] . "'>Adicionar Jogo</a>";
               echo "<a href='../editar.php?cargo=1&id=" . $logado['idAdm'] . "'>Editar Conta</a>";
               break;

            case isset($_SESSION['des']):
               echo "<a href='./addJogo.php?idDes=" . $logado['idDes'] . "'>Adicionar Jogo</a>";
               echo "<a href='../editar.php?cargo=3&id=" . $logado['idDes'] . "'>Editar Conta</a>";
               echo "<a href='../logout.php'>Logout</a>";
               break;

            default:
               echo "<a href='../login.php'>Login</a>";
               echo "<a href='../index.php'>Voltar pro Inicio</a>";
               break;
         }

         ?>
         <button id="close-menu" style="margin-top: 20px;">Fechar</button>
      </div>
   </header>

   <main>

      <table border="1">
         <tr>

            <th>Nome</th>
            <th>Imagem</th>
            <th>Desenvolvedora</th>
            <th>Preço</th>
            <th>Ações</th>
         </tr>
         <?php while ($row = $jogosDes->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
               <td><?php echo $row['nomeJogo']; ?></td>
               <td><?php echo "<img src='../uploads/" . $row['ImgJogo'] . "' alt='Foto do " . $row['nomeJogo'] . "'"; ?></td>
               <td><?php echo $row['fk_desenvolvedora']; ?></td>
               <td><?php echo $row['precoJogo']; ?></td>
               <td>
                  <a href="../deletar.php?cargo=4&id=<?php echo $row['idJogo']; ?>"><img id="imgalt" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcx1AupvWZqkA2_GijfJIDCsc1xCNXVNOkDQ&s" alt=""></a>
                  <a href="../editar.php?cargo=4&id=<?php echo $row['idJogo']; ?>"><img id="imgex" src="https://cdn.pixabay.com/photo/2017/06/06/00/33/edit-icon-2375785_640.png" alt=""></a>
                  <a href="../jogo.php?id=<?php echo $row['idJogo']; ?>"><img id="imgver" src="../assets/olho.png" alt=""></a>
               </td>
            </tr>
         <?php endwhile; ?>
      </table>

   </main>
   <script src="../js/index.js"></script>
</body>

</html>