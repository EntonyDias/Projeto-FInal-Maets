<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <header>
        <h1>login</h1>
        <a href="index.php">voltar</a>
    </header>
    <main>
        <div class="box">

            <img src="https://static.vecteezy.com/ti/vetor-gratis/t1/7033146-perfil-icone-login-head-icon-vetor.jpg" alt="">

            <form method="POST">
                <label for="email">Email</label>
                <input type="email" name="email" required>

                <label for="senha">Senha</label>
                <input type="password" name="senha" required>

                <input id="button" type="submit" name="login" value="Login">
            </form>
            <div id="mensagem">
                <?php
                //isso e basicamente para mostrar o erro que ocorrer tipo senha incorreta 
                if (isset($mensagem_erro)) echo '<p>' . $mensagem_erro . '</p>'; ?>
            </div>
            <p style="margin-top: 20px;">Não tem uma conta? <a href="registrar.php">Registre-se aqui</a></p>


    </main>
</body>
</html>