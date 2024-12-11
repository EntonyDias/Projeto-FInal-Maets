<?php
session_start();
include_once 'db/config.php';
include_once 'class/Usuario.php';
include_once 'class/Administrador.php';
include_once 'class/Desenvolvedora.php';


$usu = new Usuario($db);
$des = new Desenvolvedora($db);
$adm = new Administrador($db);


    $id = $_GET['id'];
    $cargo = $_GET['cargo'];
    if ($cargo == 1) {
        $row = $usu->lerPorId($id);
        
        
    }else if ($cargo == 2)  {
        $admin = $adm-> lerPorId($id);
        
        $row = $usu-> lerPorId($admin['fk_usuario']);
    }else{
        $row = $des->lerPorId($id);
    }


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];

    if ($cargo == 1 || $cargo == 2) {
if($_POST['senha']!= ""){
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
}else{
    $senha= $row["senhaUsu"];
    
}
    $usu->atualizar($id, $nome, $cpf, $email,$senha);

    if (isset($_SESSION['adm'])) {
        header('Location: ./adm/centralAdm.php');
        exit();
    } else {
        header('Location: index.php');
        exit();
    }
    exit();
    }else{
        if($_POST['senha']!= ""){
            $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
        }else{
            $senha= $row["senhaDes"];
            
        }
        $des->atualizar($id, $nome, $cnpj, $email, $senha);

        if (isset($_SESSION['adm'])) {
            header('Location: ./adm/centralAdm.php');
            exit();
        } else {
            header('Location: index.php');
            exit();
        }

    }
  

}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>editar</title>
</head>

<body>
<main>

<a href="">voltar</a>
<form method="POST">
    <?php

    if (isset($_GET['id'])) {

        $cargo = $_GET['cargo'];
        $id = $_GET['id'];

        switch ($cargo) {
            case 1 : 
            case 2 : ?>
               
                        <input type="hidden" name="id" value="<?php echo $row['idUsuario']; ?>">
                        <label for="nome">Nome:</label>
                        
                        <input type="text" name="nome" value="<?php echo $row['nomeUsu']; ?>" required>
                        <br><br>
                        <label>cpf:</label>
                        <input type="text" name="cpf" value="<?php echo $row['cpfUsu']; ?>" required>
                        <br><br>
                        <label for="email">Email:</label>
                        <input type="email" name="email" value="<?php echo $row['emailUsu']; ?>" required>
                        <br><br>
                        <label for="senha">senha:</label>
                        <input type="senha" name="senha" value="">
                        <br><br>
                        <input id="button" type="submit" value="Atualizar">
                   

            <?php break;
            case 3: ?>



    <input type="hidden" name="id" value="<?php echo $row['idDes']; ?>">
    <label for="nome">Nome:</label>
    <br><br>
    <input type="text" name="nome" value="<?php echo $row['nomeDes']; ?>" required>
    <br><br>
    <label>cnpj:</label>
    <input type="text" name="cpf" value="<?php echo $row['cnpjDes']; ?>" required>
    <br><br>
    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $row['emailDes']; ?>" required>
    <br><br>
    <label for="senha">senha:</label>
    <input type="senha" name="senha" value="">
    <input id="button" type="submit" value="Atualizar">



                <?php break; ?>





            <?php
            default: ?>


    <?php break;
        }
    }
    ?>
    </form>
</main>
</body>

</html>