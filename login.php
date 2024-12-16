<?php

session_start();


include_once './class/Usuario.php';
include_once './db/config.php';
include_once './class/Desenvolvedora.php';
include_once './class/Administrador.php';

$usu = new Usuario($db);
$des = new Desenvolvedora($db);
$adm = new Administrador($db);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['login'])) {
        // Processar login
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        //adm
        if ($dados_adm = $adm->login($email, $senha)) {

            $_SESSION['adm'] = $dados_adm;

            header('Location:index.php');
            exit();

            //usuario
        } else if ($dados_usuario = $usu->login($email, $senha)) {

            $_SESSION['usu'] = $dados_usuario;

            header('Location:index.php');
            exit();

            //desenvolvedora
        } else if ($dados_des = $des->login($email, $senha)) {

            $_SESSION['des'] = $dados_des;

            header('Location:./desenvolvedora/gerenciarDes.php');
            exit();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="./css/login.css?v=8">
</head>

<body>
    <header>
        <div>
            <img id="logo" src="./assets/logoTop.png" alt="">
            <h1>Login</h1>
         
        </div>
    </header>
    <a href="index.php"><img src="https://cdn-icons-png.freepik.com/256/608/608095.png?semt=ais_hybrid" alt=""></a>
    <main>
        <div id="box">
            <form id="formulario" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email" required>

                <label for="senha">Senha</label>
                <input type="password" name="senha" required>

                <input id="button" type="submit" name="login" value="Login">
                <p style="margin-top: 20px;">Não tem uma conta?<br> <a href="cadastro.php">Registre-se aqui</a></p>
            </form>
            <div id="mensagem">
                <?php
                //isso e basicamente para mostrar o erro que ocorrer tipo senha incorreta 
                if (isset($mensagem_erro)) echo '<p>' . $mensagem_erro . '</p>';
                ?>
            </div>
        </div>

    </main>
</body>

</html>