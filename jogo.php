<?PHP

session_start();

include_once './db/config.php';
include_once './class/Usuario.php';
include_once './class/Desenvolvedora.php';
include_once './class/Administrador.php';
include_once './class/Jogos.php';
include_once './class/Itens.php';

$jogosDB = new Jogo($db);
$logado = "null";

if (isset($_SESSION['adm'])) {
   $logado = $_SESSION['adm'];
} else if (isset($_SESSION['usu'])) {
   $logado = $_SESSION['usu'];
} else if (isset($_SESSION['des'])) {
   $logado = $_SESSION['des'];
}

$jogo = $jogosDB->lerPorId($_GET['id']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo $jogo['nomeJogo']; ?></title>
   <link rel="stylesheet" href="./css/jogo.css">
</head>

<body>

   <header>
      <div> <?php if (isset($_SESSION['des'])) {
               echo "<a href='./desenvolvedora/gerenciarDes.php' class='logo'><img id='logo' src='./assets/logoTop.png' alt='Logo'></a>";
            } else {
               echo "<a href='./index.php' class='logo'><img id='logo' src='./assets/logoTop.png' alt='Logo'></a>";
            } ?>
         <h1>Maets</h1>
      </div>
      <div>

         <?php if (!isset($_SESSION['des'])) {
            echo "
            <form action='pesquisar.php' method='post'>
            <input type='text' placeholder='pesquise' name='txtPesquisa'>
            <button type='submit' name='btnPesquisar'><img src='https://cdn-icons-png.flaticon.com/512/64/64673.png' alt=''></button>
         </form>";
         }


         ?>
         <?php

         switch ($logado) {
            case isset($_SESSION['adm']):


               echo " <a href='carrinho.php'>      <img id='imagem' src='https://cdn-icons-png.flaticon.com/512/4/4295.png' alt=''></a>";
               break;

            case isset($_SESSION['usu']):

               echo " <a href='carrinho.php'>      <img id='imagem' src='https://cdn-icons-png.flaticon.com/512/4/4295.png' alt=''></a>";
               break;

            case isset($_SESSION['des']):

               break;

            default:

               echo "<a href='login.php'>login</a>";
               break;
         }
         ?>


         <button class="menu-btn">&#9776;</button>
      </div>
      <div class="menu" id="menu">
         <?php
         switch ($logado) {
            case isset($_SESSION['adm']):
               echo "<a href='logout.php'>logout</a>";
               echo "<a href='editar.php?cargo=2&id=" . $logado['idAdm'] . "'>editar conta</a>";

               echo "<a href='./adm/centralAdm.php'>central de controle</a>";
               break;

            case isset($_SESSION['usu']):

               echo "<a href='editar.php?cargo=1&id=" . $logado['idUsuario'] . "'> Editar conta </a> ";
               echo "<a href='logout.php'>logout</a>";

               break;

            case isset($_SESSION['des']):

                  echo "<a href='../desenvolvedora/addJogo.php?idDes=" . $logado['idDes'] . "'>Adicionar Jogo</a>";
                  echo "<a href='./editar.php?cargo=3&id=" . $logado['idDes'] . "'>Editar Conta</a>";
                  echo "<a href='./desenvolvedora/gerenciarDes.php'>Central Desenvolvedora</a>";
                  echo "<a href='./logout.php'>Logout</a>";
                  break;

               break;


            default:
               echo "<a href='login.php'>login</a>";
               break;
         }


         ?>
         <button id="close-menu" style="margin-top: 20px;">Fechar</button>
      </div>
   </header>

   <main>
   <button id="backBtn"><img src="https://cdn-icons-png.freepik.com/256/608/608095.png?semt=ais_hybrid" alt=""></button>

      <?php
      echo "<div id='dadosJogo'>";

      echo "<div id='imagem'><img src='./uploads/" . $jogo['ImgJogo'] . "' alt='Foto do " . $jogo['nomeJogo'] . "'></div>";

      echo "<div id='nome'><h1>" . $jogo['nomeJogo'] . "</h1><br><br></div>";
      echo "<div id='precoDiv'> <p id='precoDiv'>" . $jogo['precoJogo'] . "</p></div><br><br>";


      $jogoDes = $jogosDB->infosComDesenvolvedoras($jogo['fk_desenvolvedora']);

      echo "<p> Por: " . $jogoDes['nomeDes'] . "</p><br><br>";

      if ($jogo['idadeCategJogo'] < 10) {
         echo "<img src='./assets/livreAnos.png' alt='Classificação Livre'><br><br>";
      } else if ($jogo['idadeCategJogo'] < 12) {
         echo "<img src='./assets/dezAnos.png' alt='Classificação 12 Anos'><br><br>";
      } else if ($jogo['idadeCategJogo'] < 14) {
         echo "<img src='./assets/dozeAnos.png' alt='Classificação 14 Anos'><br><br>";
      } else if ($jogo['idadeCategJogo'] < 16) {
         echo "<img src='./assets/quatorzeAnos.png' alt='Classificação 16 Anos'><br><br>";
      } else if ($jogo['idadeCategJogo'] < 18) {
         echo "<img src='./assets/dezesseisAnos.png' alt='Classificação 16 Anos'><br><br>";
      } else {
         echo "<img src='./assets/dezoitoAnos.png' alt='Classificação 16 Anos'><br><br>";
      }

      echo "<div id='descricaoDiv'> <p id='descricao'>" . $jogo['descricaoJogo'] . "</p></div><br><br>";

      echo "</div>"; ?>

      <form action="./usuarios/carrinho.php?idJogo='<?php echo $jogo['idJogo'];?>' " method="post">

         <input type="image" src="https://media.istockphoto.com/id/898475764/pt/vetorial/shopping-trolley-cart-icon-in-green-circle-vector.jpg?s=612x612&w=0&k=20&c=7UvoO8uQBi1B2P37wSiwMSN-NmNBSXOnyVAHzgvYedI=" alt="Submit" width="48" height="48">
                                             
      </form>
    

   </main>

</body>
<script src="./js/index.js"></script>
<script src="./js/voltar.js"></script>

</html>