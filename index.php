 <?php

    session_start();
    include_once './db/config.php';
    include_once './class/Usuario.php';
    include_once './class/Desenvolvedora.php';
    include_once './class/Administrador.php';


    $logado = "null";

    if (isset($_SESSION['adm'])) {
        $logado = $_SESSION['adm'];

        //usuario
    } else if (isset($_SESSION['des'])) {
        $logado = $_SESSION['des'];

        //desenvolvedora
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
             <?php
                switch ($logado) {
                    case isset($_SESSION['adm']):
                        echo "
                        <form action='pesquisar.php'' method='post'>
                            <input type='text' placeholder='pesquise' name='txtPesquisa'>
                            <button type='submit' name='btnPesquisar'><img src='https://cdn-icons-png.flaticon.com/512/64/64673.png' alt=''></button>
                        </form>";

                        echo " <a href='carrinho.php'>      <img id='imagem' src='https://cdn-icons-png.flaticon.com/512/4/4295.png' alt=''></a>";
                        break;

                    case isset($_SESSION['usu']):
                        echo "
                        <form action='pesquisar.php'' method='post'>
                            <input type='text' placeholder='pesquise' name='txtPesquisa'>
                            <button type='submit' name='btnPesquisar'><img src='https://cdn-icons-png.flaticon.com/512/64/64673.png' alt=''></button>
                        </form>";

                        echo " <a href='carrinho.php'>      <img id='imagem' src='https://cdn-icons-png.flaticon.com/512/4/4295.png' alt=''></a>";
                        break;

                    default:
                        echo "<form action='pesquisar.php'' method='post'>
                                <input type='text' placeholder='pesquise' name='txtPesquisa'>
                                <button type='submit' name='btnPesquisar'>      <img src='https://cdn-icons-png.flaticon.com/512/64/64673.png' alt=''></button>
                            </form>";


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
                        echo "<a href='./adm/centralAdm.php'>central de controle</a>";
                        echo "<a href='altConta.php'>editar conta</a>";
                        break;

                    case isset($_SESSION['usu']):

                        echo "<a href='altConta.php'>editar conta</a>";
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
                //   $row = ["lista", "de", "jogos"];
                ?>
             <?php /* while ($row = $dados->fetch(PDO::FETCH_ASSOC)) : ?>

                 <?php
                    echo "<div id='jogo'>";


                    echo "<div id='imagem'><img src='" . $row['imagem'] . "' alt='imagem do jogo'></div>";

                    echo "<div id='nome'><h1>" . $row['nome'] . "</h1>";
                    echo "<p id='descricao'>" . $row['descricao'] . "</p><br><br>";
                    echo "<p id='preco'>" . $row['preco'] . "</p><br><br>";
                    echo "por: " . $desenvolvedora['nome'] . "<br><br>";
                    echo $row['idade_cat'];




                    echo "</div></div>"; ?>
             <?php endwhile; */ ?>

         </section>

     </main>

     <script src="js/index.js"></script>
 </body>

 </html>