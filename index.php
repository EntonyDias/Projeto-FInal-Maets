 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>catalogo de jogos</title>
 </head>

 <body>
     <header>
    <h1>maets</h1>    
<form action="./" method="post">
    <select name="categoria" id="categoria">
<option value="shooter">
shooter
</option>
<option value="horror">
horror
</option>
    </select>
</form>    
<a href="">logar</a>    
</header>


<main>

<section class="jogos">
<?php
$dados ="lista dos jogos";
?>
<?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)) : ?>

    <?php
            echo "<div id='jogo'>";


            echo "<div id='imagem'><img src='" . $row['imagem'] . "' alt='imagem do jogo'></div>";

            echo "<div id='nome'><h1>" . $row['nome'] . "</h1>";
            echo "<p id='descricao'>" . $row['descricao'] . "</p><br><br>";
            echo "<p id='preco'>" . $row['preco'] . "</p><br><br>";
            echo "por: " . $desenvolvedora['nome'] . "<br><br>";
            echo $row['idade_cat'];




            echo "</div></div>"; ?>

</section>

</main>

 </body>

 </html>
 