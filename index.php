 <?php

    session_start();
    include_once './class/Usuario.php';

    $logado = null;
    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Catalogo de Jogos</title>
     <link rel="stylesheet" type="text/css" href="css/index.css">
 
 </head>

 <body>
     <header>
         <h1>maets</h1>
    
   
            <button class="menu-btn">&#9776;</button>

             <div class="menu" id="menu">
             <?php
            switch ($logado) {
                case "adm":
                    echo "<a href='logout.php'>logout</a>";
                    echo "<a href='centrarAdm.php'>central de controle</a>";
                    break;

                case "usu":echo "
                    <form action='./'' method='post'>
                    <select name='categoria' id='categoria'>
                        <option value='shooter'>
                            shooter
                        </option>
                        <option value='horror'>
                            horror
                        </option>
                    </select>
                </form>";
                    echo "<a href='logout.php'>logout</a>";
                    echo " <a href='carrinho.php'>   <img id='imagem' src='https://cdn-icons-png.flaticon.com/512/4/4295.png' alt=''></a>";
                    break;

                case "des":
                    echo "<a href='logout.php'>logout</a>";
                    echo "<a href='desenvolvedora/desenvolvedora.php'>gerenciar</a>";

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
