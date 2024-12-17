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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $pesquisa = $_POST['txtPesquisa'];
   $jogos = "null";

}

if (isset($_SESSION['adm'])) {
   echo "<button type='button'><a href='login.php'>Logara</a></button>";
} else if (isset($_SESSION['usu'])) {
   echo "<button type='button'><a href='login.php'>Logaru</a></button>";
} else if (isset($_SESSION['des'])) {
   echo "<button type='button'><a href='login.php'>Logard</a></button>";
} else {
   echo "<button type='button'><a href='login.php'>Logar</a></button>";
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Result For: <?php echo $pesquisa;?></title>
</head>

<body>
   <header>



   </header>

   <main>
      <section class="jogos">
         <?php
         $row = [];
         ?>

         <?php if ($pesquisa !== "" || $pesquisa !== " "):
            $jogos = $jogosDB->pesquisarNome($pesquisa);

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

            <?php endwhile; else :
            $jogos = $jogosDB->ler();
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


               echo "</div></div>";

            endwhile;
         endif; ?>


      </section>

   </main>

</body>

</html>