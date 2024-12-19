<?php
session_start();
include_once '../class/Jogos.php';
include_once '../class/Administrador.php';
include_once '../class/Desenvolvedora.php';
include_once '../db/config.php';

$logado = "null";

$usu = new Administrador($db);
$des = new Desenvolvedora($db);
$jogo = new Jogo($db);
$desenvelvedoras = $des->ler();
$admTrue = isset($_SESSION['adm']);

//Adm
if (isset($_SESSION['adm'])) {
    $logado = $_SESSION['adm'];

    //Des
} else if (isset($_SESSION['des'])) {
    $logado = $_SESSION['des'];

    //Usu
} else if (isset($_SESSION['usu'])) {
    header('Location: ../index.php');
    exit();
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['desen'] != "nula" && isset($_FILES['imagem'])) {


    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $idade = $_POST['idade'];
    $fk_desenvolvedora = $_POST['desen'];
    $categoriaJogo = $_POST['cat'];
    $imagem = $_FILES['imagem'];

    $nomeImagem = "";
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

        $jogo->registrar($nome, $nomeImagem, $descricao, $preco, $idade, $fk_desenvolvedora, $categoriaJogo);

        if (isset($_SESSION['adm'])) {

            header('location: ../adm/centralAdm.php');
            exit();
        } else if (isset($_SESSION['des'])) {


            header('location: ./gerenciarDes.php');
            exit();
        }
    }
} else {
    $imagem = "nula";
}



?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/addJogo.css">
</head>

<body>
    <header>
        <div>
        <?php if (isset($_SESSION['des'])) {
               echo "<a href='./gerenciarDes.php' class='logo'><img id='logo' src='../assets/logoTop.png' alt='Logo'></a>";
            } else {
               echo "<a href='../index.php' class='logo'><img id='logo' src='./assets/logoTop.png' alt='Logo'></a>";
            } ?>
            <h1>Adicionar seu jogo</h1>
        </div>
    </header>

    <?php
    if (isset($_SESSION['adm'])) {

        echo "<a href='../adm/centralAdm.php'><img src='https://cdn-icons-png.freepik.com/256/608/608095.png?semt=ais_hybrid' alt='Botão de voltar'></a>";
    } else if (isset($_SESSION['des'])) {

        echo "<a href='./gerenciarDes.php'><img src='https://cdn-icons-png.freepik.com/256/608/608095.png?semt=ais_hybrid' alt='Botão de voltar'></a>";
    }
    ?>
    <main>


        <form method="POST" action="./addJogo.php" enctype="multipart/form-data">


            <?php
            if ($admTrue) {

                echo "<label for='desen'>Selecionar Desenvolvedora:</label>
                    <select name='desen' id='desen'>
                    <option value='nula'>Desenvolvedora</option>";

                while ($row = $desenvelvedoras->fetch(PDO::FETCH_ASSOC)) {

                    echo "<option value='" . htmlspecialchars($row['idDes']) . "'>" . htmlspecialchars($row['nomeDes']) . "</option>";
                }
                echo "</select>";
            } else {
                echo "
                    <select name='desen' id='desen' hidden>
                    <option value='" . htmlspecialchars($logado['idDes']) . "' hidden></option>";
            }
            ?>

            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['desen'] == "nula") {
                echo "<p>Selecione uma desenvolvedora</p>";
            } ?>


            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required placeholder="Nome do Game">

            <label class="imagemLabel" for="imagem">Escolher Imagem</label>
            <input type="file" name="imagem" id="imagem" />

            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagem'])) {
                echo "<p>Selecione uma Imagem</p>";
            } ?>

            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" placeholder="Escreva sua descrição aqui..." required></textarea>


            <label for="preco">Preço:</label>
            <input type="number" name="preco" id="preco" required>

            <label for="idade">Idade Categórica:</label>
            <input type="number" name="idade" id="idade" required step="1">

            <label for="cat">Categória/Gênero:</label>
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
        </form>
    </main>

</body>
<script src="../js/voltar.js"> </script>

</html>