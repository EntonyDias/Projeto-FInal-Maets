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

    }
    else if ($cargo == 2) {
        $row = $adm->lerPorId($id);
    } else {
        $row = $des->lerPorId($id);
    }


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];
    if ($cargo == 1) {
    $usu->atualizar($id, $nome, $cpf, $email,$row['senhaUsu']);

    if (isset($_SESSION['adm'])) {
        header('Location: ./adm/centralAdm.php');
        exit();
    } else {
        header('Location: index.php');
        exit();
    }
    exit();
    }else{
        $des->atualizar($id, $nome, $sexo, $fone, $email);

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
    <title>Document</title>
</head>

<body>
<main>

<form method="POST">
    <?php

    if (isset($_GET['id'])) {

        $cargo = $_GET['cargo'];
        $id = $_GET['id'];

        switch ($cargo) {
            case 1: ?>
               
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
                        <input id="button" type="submit" value="Atualizar">
                   

            <?php break;
            case 2: ?>



    <input type="hidden" name="id" value="<?php echo $row['idUsuario']; ?>">
    <label for="nome">Nome:</label>
    <br><br>
    <input type="text" name="nome" value="<?php echo $row['nomeUsu']; ?>" required>
    <br><br>
    <label>cpf:</label>
    <input type="text" name="cpf" value="<?php echo $row['cpfUsu']; ?>" required>
    <br><br>
    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $row['emailUsu']; ?>" required>
    <br><br>
    <input id="button" type="submit" value="Atualizar">

            <?php break;

            case 'adm': ?>
<main>


    <input type="hidden" name="id" value="<?php echo $row['idUsuario']; ?>">
    <label for="nome">Nome:</label>
    <br><br>
    <input type="text" name="nome" value="<?php echo $row['nomeUsu']; ?>" required>
    <br><br>
    <label>cpf:</label>
    <input type="text" name="cpf" value="<?php echo $row['cpfUsu']; ?>" required>
    <br><br>
    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $row['emailUsu']; ?>" required>
    <br><br>
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