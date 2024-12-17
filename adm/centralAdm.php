<?php 
session_start();
include_once '../db/config.php';
include_once '../class/Usuario.php';
include_once '../class/Administrador.php';
include_once '../class/Desenvolvedora.php';
include_once '../class/Jogos.php';
$tela=null;
$logado = "null";
$mensagem = "";

$usu = new Usuario($db);
$adm = new Administrador($db);
$des = new Desenvolvedora($db);
$jogosDB = new Jogo($db);

$dadosUsu = $usu->ler();
$dadosAdm = $adm->ler();
$dadosDes = $des->ler();

if (!isset($_SESSION['adm'])) {
    header('Location: index.php');
    exit();
}
    $logado = $_SESSION['adm'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if(isset($_POST['acao'])){
    $tela = isset($_POST['acao']) ? $_POST['acao'] : '';
    }
    

    
        if(isset($_POST['id'])){
    
        while ($row = $dadosAdm->fetch(PDO::FETCH_ASSOC)) :
            if($row['fk_usuario']!= $_POST['id']){

            $adm->registrar($_POST['id']);
            }else{
          $mensagem = "Adiministrador ja registrado";
            };
            
        endwhile;
        }
    
}

// Processar exclusão de usuário




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
    
    <button class="menu-btn">&#9776;</button>
</div>
</header>

<body>
<div class="menu" id="menu">
    <?php
    switch ($tela) {
        case 'usuario':?>

        
     <?php break;
   case 'jogo':?>
   
    <?php break;
      default:
     
    }
    ?>
    <a href='../editar.php?cargo=2&id="<?php $logado['idAdm']?>'>editar conta</a>
    <a href='../logout.php'>logout</a>
<button id="close-menu" style="margin-top: 20px;">Fechar</button>
</div>
    <a href="../index.php"><img src="https://cdn-icons-png.freepik.com/256/608/608095.png?semt=ais_hybrid" alt=""></a>
    <main>    
<?php

switch ($tela) {
    case 'usuario':?>
  
  
  <section class="usuarios">

        
        <div>
            <h1>gerenciamento de usuarios</h1>
 
        <table border="1">
            <tr>

                <th>Nome</th>
                <th>cpf</th>
                <th>email</th>
                <th>Email</th>
            </tr>
            <?php while ($row = $dadosUsu->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>

                    <td><?php echo $row['nomeUsu']; ?></td>
                    <td><?php echo $row['cpfUsu'] ?></td>
                    <td><?php echo $row['emailUsu']; ?></td>
                    <td>
                        <a href="../deletar.php?cargo=1&id=<?php echo $row['idUsuario']; ?>"><img id="imgalt" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcx1AupvWZqkA2_GijfJIDCsc1xCNXVNOkDQ&s" alt=""></a>
                        <a href="../editar.php?cargo=1&id=<?php echo $row['idUsuario']; ?>"><img id="imgex" src="https://cdn.pixabay.com/photo/2017/06/06/00/33/edit-icon-2375785_640.png" alt=""></a>
                        <form  action="" method="post">
                        <input type="image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRBhjoZmqCRAQ5zUbhsMXksI0DgZnK-ThRSSuQgBVJKHP9VjkE6v2BturFKr_oprzUD1XM&usqp=CAU" alt="Submit" width="48" height="48">
        <input type="hidden" name="id" value="<?php echo $row['idUsuario']; ?>">
    </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        </div><div>
        <h1>gerenciamento de administradores</h1>
 

     <table border="1">
         <tr>

             <th>Nome</th>
             <th>cpf</th>
             <th>email</th>
             <th>Email</th>
         </tr>
         <?php while ($row = $dadosAdm->fetch(PDO::FETCH_ASSOC)) : ?>
            <?php
$admInfo=$usu->lerPorId( $row['fk_usuario']);
?>
            
            <tr>

                 <td><?php echo $admInfo['nomeUsu']; ?></td>
                 <td><?php echo $admInfo['cpfUsu'] ?></td>
                 <td><?php echo $admInfo['emailUsu']; ?></td>
                 <td>
                     <a href="../deletar.php?cargo=2&id=<?php echo $row['idAdm']; ?>"><img id="imgalt" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcx1AupvWZqkA2_GijfJIDCsc1xCNXVNOkDQ&s" alt=""></a>
                     <a href="../editar.php?cargo=2&id=<?php echo $row['idAdm']; ?>"><img id="imgex" src="https://cdn.pixabay.com/photo/2017/06/06/00/33/edit-icon-2375785_640.png" alt=""></a>
                 </td>
             </tr>
         <?php endwhile; ?>
     </table></div><div>
     <h1>gerenciamento de Desenvolvedoras</h1>
 

     <table border="1">
         <?php while ($row = $dadosDes->fetch(PDO::FETCH_ASSOC)) : ?>
               
            <tr>

                 <td><?php echo $row['nomeDes']; ?></td>
                 <td><?php echo $row['cnpjDes'] ?></td>
                 <td><?php echo $row['emailDes']; ?></td>
                 <td>
                     <a href="../deletar.php?cargo=3&id=<?php echo $row['idDes']; ?>"><img id="imgalt" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcx1AupvWZqkA2_GijfJIDCsc1xCNXVNOkDQ&s" alt=""></a>
                     <a href="../editar.php?cargo=3&id=<?php echo $row['idDes']; ?>"><img id="imgex" src="https://cdn.pixabay.com/photo/2017/06/06/00/33/edit-icon-2375785_640.png" alt=""></a>
                     <a href="../desenvolvedora/gerenciarDes.php?idDes=<?php echo $row['idDes']; ?>"><img id="imgex" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2qny-bPSPmnz8Ksa3X8iE_B7SI8JILM9Xsw&s" alt=""></a>
                 </td>
             </tr>
         <?php endwhile; ?>
     </table></div>
     </section>
        
<div>
    <a href="../cadastro.php">cadastrar novo <b>usuario</b> / <b> desenvolvedora</b></a>
</div>


  <?php break;
   case 'jogo':?>

<section class="jogo">


             <?php

                $jogos = $jogosDB->ler();
                
                $row = [];
               
                while ($row = $jogos->fetch(PDO::FETCH_ASSOC)) :

                    echo "<div id='ListaJogos'>";
                    
                    echo "<div id='imagem'><img src='../uploads/". $row['ImgJogo']."' alt='Foto do ".$row['nomeJogo']."'></div>";

                    echo "<div id='nome'><h1>" . $row['nomeJogo'] . "</h1><br><br></div>";
                    echo "<div id='precoDiv'> <p id='precoDiv'>" . $row['precoJogo'] . "</p></div><br><br>";
                    
                    $jogo = $jogosDB->infosComDesenvolvedoras($row['fk_desenvolvedora']);

                    echo "<p> Por: " . $jogo['nomeDes'] ."</p><br><br>";
echo "<div id='idade'>";
                    if($row['idadeCategJogo'] < 10){
                        echo "<img src='../assets/livreAnos.png' alt='Classificação Livre'><br><br>";
                    } else if($row['idadeCategJogo'] < 12){
                        echo "<img src='../assets/dezAnos.png' alt='Classificação 12 Anos'><br><br>";
                    }else if($row['idadeCategJogo'] < 14){
                        echo "<img src='../assets/dozeAnos.png' alt='Classificação 14 Anos'><br><br>";
                    }else if($row['idadeCategJogo'] < 16){
                        echo "<img src='../assets/quatorzeAnos.png' alt='Classificação 16 Anos'><br><br>";
                    }else if($row['idadeCategJogo'] < 18){
                        echo "<img src='../assets/dezesseisAnos.png' alt='Classificação 16 Anos'><br><br>";
                    }else {
                        echo "<img src='../assets/dezoitoAnos.png' alt='Classificação 16 Anos'><br><br>";
                    }

               echo "    
               <a href='../editar.php?cargo=4&id=". $row['idJogo']."'><img id='imgex' src='https://cdn.pixabay.com/photo/2017/06/06/00/33/edit-icon-2375785_640.png' alt=''></a>
                    <a href='../deletar.php?cargo=4&id=" .$row['idJogo']."'><img id='imgalt' src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcx1AupvWZqkA2_GijfJIDCsc1xCNXVNOkDQ&s' alt=''></a>
               </div></div></div>";
                endwhile; ?>
             
</section>
<a href="../desenvolvedora/addJogo.php">cadastrar novo <b>Jogo</b></a>


    <?php break;

    default:

     echo $mensagem;
}
?>
    
    </main>
    <script src="../js/index.js"></script>
</body>
</html>
