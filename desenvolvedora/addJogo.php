<?php
session_start();
include_once '../class/Jogos.php';
include_once '../class/Administrador.php';
include_once '../class/Desenvolvedora.php';
include_once '../db/config.php';

$logado = "null";

//Adm
if (isset($_SESSION['adm'])) {
    $logado = $_SESSION['adm'];
    $dados_des = $desenvolvedora->lerPorId($logado['idDes']);

    //Des
} else if (isset($_SESSION['des'])) {
    $logado = $_SESSION['des'];
    $dados_des = $desenvolvedora->lerPorId($logado['idDes']);

    //Usu
} else if (isset($_SESSION['usu'])) {
    header('Location: ../index.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usu = new Administrador($db);
    $des = new Desenvolvedora($db);
    $jogo = new Jogo($db);

    $nome = $_POST['nome'];
    $Img = $_POST['img'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $idade = $_POST['idade'];
    $fk_desenvolvedora = $_POST['desen'];
    $categoriaJogo = $_POST['cat'];

    if ($_POST['cargo'] == "adm") {
        $usu->registrar($nome, $cpf, $email, $senha);

        header('Location: index.php');

        exit();
    } else {
        $des->registrar($nome, $cpf, $email, $senha);

        header('Location: index.php');

        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/cadastro.css">
</head>

<body>
    <header>
        <h1>Adicionar seu jogo</h1>
    </header>
    <a href="login.php">voltar</a>
    <main>
        <img id="logo" src="https://png.pngtree.com/png-vector/20230909/ourmid/pngtree-cool-emoticon-cut-out-png-image_9222499.png" alt="">


        <form method="POST">

            <?php
            if ($_SESSION['adm']) {
                echo "<label for='cargo'>tipo de usuario:</label>
            <select name='cargo' id='cargo'>
                    <option value='usu'>usuario</option>
                    <option value='des'>desenvolvedora</option>
            </select>";
            }
            ?>

            <label for="nome">Nome:</label>
            <input type="text" name="nome" required>



            <label for="cpf">Cpf/cnpj:</label>
            <input type="text" name="cpf" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" required>



            <input id="button" type="submit" value="Adicionar">
        </form>
    </main>

</body>

</html>