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
         <div><img id="logo" src="./assets/logoTop.png" alt="">
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
                
                $row = [];
                ?>

             <?php while ($row = $jogos->fetch(PDO::FETCH_ASSOC)) : ?>

                 <?php
                    echo "<div id='ListaJogos'>";
                    
                    echo "<div id='imagem'><img src='./uploads/". $row['ImgJogo']."' alt='Foto do ".$row['nomeJogo']."'></div>";

                    echo "<div id='nome'><h1>" . $row['nomeJogo'] . "</h1><br><br></div>";
                    echo "<div id='precoDiv'> <p id='precoDiv'>" . $row['precoJogo'] . "</p></div><br><br>";
                    
                    $jogo = $jogosDB->infosComDesenvolvedoras($row['fk_desenvolvedora']);

                    echo "<p> Por: " . $jogo['nomeDes'] ."</p><br><br>";

                    if($row['idadeCategJogo'] < 10){
                        echo "<img src='./assets/livreAnos.png' alt='Classificação Livre'><br><br>";
                    } else if($row['idadeCategJogo'] < 12){
                        echo "<img src='./assets/dezAnos.png' alt='Classificação 12 Anos'><br><br>";
                    }else if($row['idadeCategJogo'] < 14){
                        echo "<img src='./assets/dozeAnos.png' alt='Classificação 14 Anos'><br><br>";
                    }else if($row['idadeCategJogo'] < 16){
                        echo "<img src='./assets/quatorzeAnos.png' alt='Classificação 16 Anos'><br><br>";
                    }else if($row['idadeCategJogo'] < 18){
                        echo "<img src='./assets/dezesseisAnos.png' alt='Classificação 16 Anos'><br><br>";
                    }else {
                        echo "<img src='./assets/dezoitoAnos.png' alt='Classificação 16 Anos'><br><br>";
                    }

                    echo "</div></div>"; ?>

             <?php endwhile; ?>


         </section>

     </main>

     <script src="js/index.js"></script>
 </body>

 </html>