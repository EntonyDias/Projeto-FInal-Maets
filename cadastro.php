<?php

include_once './class/Usuario.php';
include_once './class/Desenvolvedora.php';
include_once './db/config.php';

//e so ler que tu entende
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usu = new Usuario($db);
    $des = new Desenvolvedora($db);

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    if ($_POST['cargo'] == "usu") {
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
        <div>
            <img id="logo" src="./assets/logoTop.png" alt="LogoTop">
            <h1>Cadastro</h1>
        </div>
    </header>
    <button id="backBtn" ><img src="https://cdn-icons-png.freepik.com/256/608/608095.png?semt=ais_hybrid" alt=""></button>
    <main>
        <form id="formulario" method="POST">
            <label for="cargo">Tipo de usuario:</label>
            <select name="cargo" id="cargo">
                <option value="usu">usuario</option>

                <option value="des">desenvolvedora</option>

            </select>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required>



            <label for="cpf">Cpf/cnpj:</label>
            <input type="text" name="cpf" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" required>



            <button id="button" type="submit">Adicionar</button>
        </form>
    </main>
    <script src="js/voltar.js"></script>
</body>

</html>