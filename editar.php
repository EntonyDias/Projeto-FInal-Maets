<?php
session_start();
include_once 'db/config.php';
include_once 'class/Usuario.php';
include_once 'class/Administrador.php';
include_once 'class/Desenvolvedora.php';
include_once 'class/jogos.php';

$logado = "";

$usu = new Usuario($db);
$des = new Desenvolvedora($db);
$adm = new Administrador($db);
$jogo = new jogo($db);

if (isset($_SESSION['adm'])) {

    $logado = $_SESSION['adm'];
} else if ($_SESSION['des']) {

    $logado = $_SESSION['des'];
} else if ($_SESSION['usu']) {

    $logado = $_SESSION['usu'];
}

$id = $_GET['id'];
$cargo = $_GET['cargo'];
if ($cargo == 1) {
    $row = $usu->lerPorId($id);
} else if ($cargo == 2) {
    $admin = $adm->lerPorId($id);

    $row = $usu->lerPorId($admin['fk_usuario']);
} else if ($cargo == 3) {

    $row = $des->lerPorId($id);
} else {

    $row = $jogo->lerPorId($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    //jogo
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $idade = $_POST['idade'];
    $fk_desenvolvedora = $_POST['desen'];
    $categoriaJogo = $_POST['cat'];
    $imagem = $_FILES['imagem'];

    $nomeImagem = "";

    if ($cargo == 1 || $cargo == 2) {
        if ($_POST['senha'] != "") {
            $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
        } else {
            $senha = $row["senhaUsu"];
        }

        $usu->atualizar($id, $nome, $cpf, $email, $senha);
        if (isset($_SESSION['adm'])) {
            header('Location: ./adm/centralAdm.php');

            exit();
        } else {
            header('Location: index.php');

            exit();
        }
    } else if ($cargo == 3) {
        if ($_POST['senha'] != "") {
            $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
        } else {
            $senha = $row["senhaDes"];
        }
        $des->atualizar($id, $nome, $cpf, $email, $senha);

        if (isset($_SESSION['adm'])) {

            header('Location: ./adm/centralAdm.php');
            exit();
        } else {
            header('Location: index.php');

            exit();
        }
    } else {
        if ($imagem != null) {
            if ($imagem['error'] === UPLOAD_ERR_OK) {
                $extensao = strtolower(pathinfo($imagem['name'], PATHINFO_EXTENSION));
                $tamanho = 10 * 1024 * 1024; //10mb

                //validar tipos de arquivos
                $tiposPermitidos = ['jpg', 'jpeg', 'png'];
                if (!in_array($extensao, $tiposPermitidos)) {
                    die("Apenas arquivos JPG, JPEG e PNG são permitidas");
                }
                if ($imagem['size'] > $tamanho) {
                    die("O tamanho do arquivo não pode execer 10MB");
                }

                //gerar nome único para o arquivo
                $nomeImagem = uniqid() . "." . $extensao;
                $destino = "../uploads/" . $nomeImagem;

                //mover o arquivo para o diretório
                if (!move_uploaded_file($imagem['tmp_name'], $destino)) {
                    die("erro ao salvar a imagem");
                } else if ($imagem['error'] !== UPLOAD_ERR_OK) {
                    die("erro ao fazer upload da imagem");
                }
            } else {
                $nomeImagem = $row['imgJogo'];
            }
            $jogo->atualizar($id, $nome, $nomeImagem, $descricao, $preco, $idade,  $fk_desenvolvedora, $categoriaJogo);

            if (isset($_SESSION['adm'])) {

                header('location: ../adm/centralAdm.php');
                exit();
            } else if (isset($_SESSION['des'])) {


                header('location: ./gerenciarDes.php');
                exit();
            }
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
    <link rel="stylesheet" href="./css/editar.css">
</head>

<body>
    <header>
        <div>
            <button class="logo" href="./index.php"><img id="logo" src="./assets/logoTop.png" alt=""></button>
            <h1>Cadastro</h1>
        </div>
    </header>
    <main>

        <button id="backBtn"><img src="https://cdn-icons-png.freepik.com/256/608/608095.png?semt=ais_hybrid" alt=""></button>
        <form method="POST" id="formulario">
            <?php

            if (isset($_GET['id'])) {

                $cargo = $_GET['cargo'];
                $id = $_GET['id'];

                switch ($cargo) {
                    case 1:
                    case 2: ?>

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
                        <button id="button" type="submit">Atualizar</button>

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
                        <br><br>
                        <button id="button" type="submit">Atualizar</button>


                    <?php break;
                    case 4: ?>



                        <input type="hidden" name="id" value="<?php echo $row['idJogo']; ?>">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" value='<?php echo $row['nomeJogo'] ?>'>

                        <label for="imagem">Imagem:</label>
                        <input type="file" name="imagem" id="imagem">

                        <label for="descricao">Descrição:</label>
                        <textarea name="descricao" id="descricao" required placeholder="Descrição do jogo" rows="8" cols="8">'<?php echo $row['descricaoJogo'] ?></textarea>

                        <label for="preco">Preço:</label>
                        <input type="number" name="preco" id="preco" value="<?php echo $row['precoJogo'] ?>" required>

                        <label for="idade">Idade Categórica:</label>
                        <input type="number" name="idade" id="idade" required step="1" value="<?php echo $row['idadeCategJogo'] ?>">

                        <label for="cat">Categória/Gênero:</label>
                        <label for="cat">Categória atual: <b> <?php echo $row['categoriaJogo'] ?></b></label>
                        <select name='cat' id='cat' required>
                            <option value='Acao'>Ação</option>
                            <option value='Aventura'>Aventura</option>
                            <option value='FPS'>FPS</option>
                            <option value='RPG'>RPG</option>
                            <option value='MMORPG'>MMORPG</option>
                            <option value='Estrategia'>Estratégia</option>
                            <option value='Esporte'>Esporte</option>
                            <option value='Corrida'>Corrida</option>
                            <option value='Luta'>Luta</option>
                            <option value='Plataforma'>Plataforma</option>
                            <option value='SoulsBorn'>SoulsBorn</option>
                            <option value='Metroidvania'>Metroidvania</option>
                            <option value='Mundo Aberto'>Mundo Aberto</option>
                            <option value='Sandbox'>Sandbox</option>
                            <option value='VR'>VR</option>
                            <option value='Simulator'>Simulator</option>
                            <option value='Casual'>Casual</option>
                        </select>


                        <input id="button" type="submit" value="Adicionar">
                        <button id="button" type="submit">Atualizar</button>


                        <?php break; ?>
                    <?php
                    default: ?>


            <?php break;
                }
            }
            ?>
        </form>
    </main>
    <script src="./js/voltar.js"></script>
</body>

</html>