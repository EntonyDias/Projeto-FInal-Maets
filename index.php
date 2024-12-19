 <?php

    session_start();

    include_once './db/config.php';
    include_once './class/Usuario.php';
    include_once './class/Desenvolvedora.php';
    include_once './class/Administrador.php';
    include_once './class/Jogos.php';

    $jogosDB = new Jogo($db);
    $logado = "null";

    if (isset($_SESSION['adm'])) {
        $logado = $_SESSION['adm'];
    } else if (isset($_SESSION['des'])) {
        $logado = $_SESSION['des'];
    } else if (isset($_SESSION['usu'])) {
        $logado = $_SESSION['usu'];
    }



    ?>

 <!DOCTYPE html>
 <html lang="pt-br">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Catalogo de Jogos</title>
     <link rel="stylesheet" type="text/css" href="css/index.css">

 </head>

 <body>
     <header>
         <div>
             <a href="./index.php" class="logo"><img id="logo" src="./assets/logoTop.png" alt="Logo"></a>
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
                $jogos = $jogosDB->ler();

                while ($row = $jogos->fetch(PDO::FETCH_ASSOC)) :
                    $jogo = $jogosDB->infosComDesenvolvedoras($row['fk_desenvolvedora']);
                ?>
                 <div class="jogo-card">
                     <a href="./jogo.php?id=<?= $row['idJogo'] ?>">
                         <img src="./uploads/<?= $row['ImgJogo'] ?>" alt="<?= $row['nomeJogo'] ?>">
                         <div class="info">
                             <h2><?= $row['nomeJogo'] ?></h2>
                             <p class="preco">R$ <?= number_format($row['precoJogo'], 2, ',', '.') ?></p>
                             <p class="dev">Por: <?= $jogo['nomeDes'] ?></p>
                         </div>
                         <div class="classificacao">
                             <?php if ($row['idadeCategJogo'] < 10) : ?>
                                 <img src="./assets/livreAnos.png" alt="Livre">
                             <?php elseif ($row['idadeCategJogo'] < 12) : ?>
                                 <img src="./assets/dezAnos.png" alt="10+">
                             <?php elseif ($row['idadeCategJogo'] < 14) : ?>
                                 <img src="./assets/dozeAnos.png" alt="12+">
                             <?php elseif ($row['idadeCategJogo'] < 16) : ?>
                                 <img src="./assets/quatorzeAnos.png" alt="14+">
                             <?php elseif ($row['idadeCategJogo'] < 18) : ?>
                                 <img src="./assets/dezesseisAnos.png" alt="16+">
                             <?php else : ?>
                                 <img src="./assets/dezoitoAnos.png" alt="18+">
                             <?php endif; ?>
                         </div>
                     </a>
                 </div>
             <?php endwhile; ?>
         </section>


     </main>

     <script src="js/index.js"></script>
 </body>

 </html>