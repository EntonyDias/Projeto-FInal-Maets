<?PHP
session_start();

include_once "./db/config.php";
include_once "./class/Jogos.php";

$jogosDB = new Jogo($db);

$logado = "null";

if (isset($_SESSION['adm'])) {
   $logado = $_SESSION['adm'];
} else if (isset($_SESSION['usu'])) {
   $logado = $_SESSION['usu'];
} else if (isset($_SESSION['des'])) {
   $logado = $_SESSION['des'];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cat'])) {
   $pesquisa = $_POST['txtPesquisa'];
   $cat = $_POST['cat'];
   $jogos = "null";
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $pesquisa = $_POST['txtPesquisa'];
   $cat = "";
   $jogos = "null";
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Result For: <?php echo $pesquisa; ?></title>
   <link rel="stylesheet" href="./css/pesquisar.css">
</head>

<body>
   <header>
      <div>
         <button class="logo" href="./index.php"><img id="logo" src="./assets/logoTop.png" alt=""></button>
         <h1>Maets</h1>
      </div>
      <div>
         <form action='pesquisar.php' method='post'>
            <input type='text' placeholder='pesquise' name='txtPesquisa'>
            <button type='submit' name='btnPesquisar'><img src='https://cdn-icons-png.flaticon.com/512/64/64673.png' alt=''></button>
         </form>
         <?php

         switch ($logado) {
            case isset($_SESSION['adm']):


               echo " <a href='carrinho.php'>      <img id='imagem' src='https://cdn-icons-png.flaticon.com/512/4/4295.png' alt=''></a>";
               break;

            case isset($_SESSION['usu']):

               echo " <a href='carrinho.php'>      <img id='imagem' src='https://cdn-icons-png.flaticon.com/512/4/4295.png' alt=''></a>";
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


            default:
               echo "<a href='login.php'>login</a>";
               break;
         }


         ?>
         <button id="close-menu" style="margin-top: 20px;">Fechar</button>
      </div>
   </header>

   <main>
      <section class="jogos">

         <?php

         $row = [];

         if ($pesquisa !== "" && $cat == "" || $pesquisa !== " " && $cat == "") {
            $jogos = $jogosDB->pesquisarNome($pesquisa);
         } else if ($pesquisa == "" && $cat == "" || $pesquisa == " " && $cat == "") {
            $jogos = $jogosDB->ler();
         } else if ($pesquisa == "" && $cat == "" || $pesquisa == " " && $cat == "") {
            $jogos = $jogosDB->ler();
         } else if ($pesquisa == "" && $cat == "" || $pesquisa == " " && $cat == "") {
            $jogos = $jogosDB->ler();
         }

         if ($jogos != "null") :
            while ($row = $jogos->fetch(PDO::FETCH_ASSOC)) : ?>

               <?php
               echo "<div id='ListaJogos'>";

               echo "<div id='imagem'><img src='./uploads/" . $row['ImgJogo'] . "' alt='Foto do " . $row['nomeJogo'] . "'></div>";

               echo "<div id='nome'><h1>" . $row['nomeJogo'] . "</h1><br><br></div>";
               echo "<div id='precoDiv'> <p id='precoDiv'>" . $row['precoJogo'] . "</p></div><br><br>";

               $jogo = $jogosDB->infosComDesenvolvedoras($row['fk_desenvolvedora']);

               echo "<p> Por: " . $jogo['nomeDes'] . "</p><br><br>";

               if ($row['idadeCategJogo'] < 10) {
                  echo "<img src='./assets/livreAnos.png' alt='Classificação Livre'><br><br>";
               } else if ($row['idadeCategJogo'] < 12) {
                  echo "<img src='./assets/dezAnos.png' alt='Classificação 10 Anos'><br><br>";
               } else if ($row['idadeCategJogo'] < 14) {
                  echo "<img src='./assets/dozeAnos.png' alt='Classificação 12 Anos'><br><br>";
               } else if ($row['idadeCategJogo'] < 16) {
                  echo "<img src='./assets/quatorzeAnos.png' alt='Classificação 14 Anos'><br><br>";
               } else if ($row['idadeCategJogo'] < 18) {
                  echo "<img src='./assets/dezesseisAnos.png' alt='Classificação 16 Anos'><br><br>";
               } else {
                  echo "<img src='./assets/dezoitoAnos.png' alt='Classificação 18 Anos'><br><br>";
               }


               echo "</div></div>"; ?>

         <?php endwhile;
         endif; ?>





      </section>

      <section>

         <form action="pesquisar.php" method="POST">
            <input type="text" name="txtPesquisa" value="<?php echo "$pesquisa"; ?>" hidden>

            <label for="cat">Categória/Gênero:</label>
            <select name='cat' id='cat' required>

               <?php if ($cat != "") {
                  echo "<option value='" . $cat . "'>" . $cat . "</option>";
               }
               ?>
               <option value=''>Nenhuma</option>

               <option value='Acao'>Ação</option>
               <option value='Aventura'>Aventura</option>
               <option value='FPS'>FPS</option>
               <option value='RPG'>RPG</option>
               <option value='MMORPG'>MMORPG</option>
               <option value='Estrategia'>Estratégia</option>
               <option value='Esporte'>Esporte</option>
               <option value='Corrida'>Corrida</option>
               <option value='Luta'>Luta</option>
               <option value='Plataforma'>Plataforma</option>
               <option value='SoulsBorn'>SoulsBorn</option>
               <option value='Metroidvania'>Metroidvania</option>
               <option value='Mundo Aberto'>Mundo Aberto</option>
               <option value='Sandbox'>Sandbox</option>
               <option value='VR'>VR</option>
               <option value='Simulator'>Simulator</option>
               <option value='Casual'>Casual</option>
            </select>
            <button type="submit">Filtrar</button>
         </form>

      </section>

   </main>

</body>

<script src="./js/index.js"></script>

</html>