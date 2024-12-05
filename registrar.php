<?php

include_once './class/Usuario.php';
include_once './db/config.php';

//e so ler que tu entende
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario = new Usuario($db);

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $usuario->registrar($nome, $cpf, $email, $senha);

    header('Location: index.php');

    exit();
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
        <h1>cadastrar Usuário</h1>
    </header>
    <a href="login.php">voltar</a>
    <main>
        <img id="logo" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSE1celiaX-o-k4pxKqTtoCIvGYVil4ilQXqoqQ7SihOtZbHpYy34Jlmgrw7bJvww9hZE8&usqp=CAU" alt="">
        <form method="POST">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required>

          

            <label for="cpf">Cpf:</label>
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