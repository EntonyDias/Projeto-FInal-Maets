<?php
session_start();

include_once '../db/config.php';
include_once '../class/Usuario.php';
include_once '../class/Desenvolvedora.php';
include_once '../class/Administrador.php';
include_once '../class/Jogos.php';
include_once '../class/Carrinho.php';
include_once '../class/Itens.php';
include_once '../class/Biblioteca.php';

$logado = "null";

if (isset($_SESSION['adm'])) {
    $logado = $_SESSION['adm'];
} else if (isset($_SESSION['des'])) {
    header('Location: ../desenvolvedora.php');
} else if (isset($_SESSION['usu'])) {
    $logado = $_SESSION['usu'];
}
//coisas acontecen dps


$car = new Carrinho($db);
$itensDB = new Item($db);
$bib = new Biblioteca($db);
$carr = "null";
$bibl = "null";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //verica se tem um pendenbte

    if (isset($_SESSION['adm'])) {
        $carr = $car->verificarStatus($logado['idAdm']);
    } else if (isset($_SESSION['usu'])) {
        $carr = $car->verificarStatus($logado['idUsuario']);
    }

    // se n tiv er pendednte cria um
    if (!$carr) {
        if (isset($_SESSION['adm'])) {
            $carr = $car->registrar("p", $logado['idAdm']);
            $carr = $car->verificarPendente($logado['idAdm']);
        } else if (isset($_SESSION['usu'])) {
            $carr = $car->registrar("p", $logado['idUsuario']);
            $carr = $car->verificarPendente($logado['idUsuario']);
        }
    } else {
        //pega os dados do carrinho
        if (isset($_SESSION['adm'])) {
            $carr = $car->verificarPendente($logado['idAdm']);
        } else if (isset($_SESSION['usu'])) {
            $carr = $car->verificarPendente($logado['idUsuario']);
        }
    }

    

    //se n tiver biblioteca ele cria
        if (isset($_SESSION['adm'])) {
            $bibl = $bib->registrar(1,$logado['idAdm']);
        } else if (isset($_SESSION['usu'])) {
            $bibl = $bib->registrar(1,$logado['idUsuario']);
        }
    }





    // if (isset($_SESSION['adm'])) {
    //     $bli = $carrinhoDB->verificarStatus($logado['idAdm']);
    // } else if (isset($_SESSION['usu'])) {
    //     $carr = $car->verificarStatus($logado['idUsuario']);
    // }


    $itensDB->registrar($_GET['idJogo'], $carr['idCarrinho'], $bibl['idBiblioteca']);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>carrinho</title>
    <link rel="stylesheet" href="css/carrinho.css">
</head>

<body>
    <header>
        <h1>maets</h1>
        <a href='index.php'>voltar</a>
    </header>
    <main>

        <!-- BandeideRalampago 
    <?php while ($row = $jogos->fetch(PDO::FETCH_ASSOC)) : ?>

<?php
        echo "<div id='dadosJogo'> <a href='./jogo.php?id=" . $row['idJogo'] . "'>";

        echo "<div id='imagem'><img src='./uploads/" . $row['ImgJogo'] . "' alt='Foto do " . $row['nomeJogo'] . "'></div>";

        echo "<div id='nome'><h1>" . $row['nomeJogo'] . "</h1><br><br></div>";
        echo "<div id='precoDiv'> <p id='preco'>" . $row['precoJogo'] . "</p></div><br><br>";

        $jogo = $jogosDB->infosComDesenvolvedoras($row['fk_desenvolvedora']);

        echo "<p> Por: " . $jogo['nomeDes'] . "</p><br><br>";

        if ($row['idadeCategJogo'] < 10) {
            echo "<img src='./assets/livreAnos.png' alt='Classificação Livre'><br><br>";
        } else if ($row['idadeCategJogo'] < 12) {
            echo "<img src='./assets/dezAnos.png' alt='Classificação 12 Anos'><br><br>";
        } else if ($row['idadeCategJogo'] < 14) {
            echo "<img src='./assets/dozeAnos.png' alt='Classificação 14 Anos'><br><br>";
        } else if ($row['idadeCategJogo'] < 16) {
            echo "<img src='./assets/quatorzeAnos.png' alt='Classificação 16 Anos'><br><br>";
        } else if ($row['idadeCategJogo'] < 18) {
            echo "<img src='./assets/dezesseisAnos.png' alt='Classificação 16 Anos'><br><br>";
        } else {
            echo "<img src='./assets/dezoitoAnos.png' alt='Classificação 16 Anos'><br><br>";
        }

        echo "</a></div>"; ?>

<?php endwhile; ?> -->



        <table border="1">
            <tr>

                <th>Nome</th>
                <th>Imagem</th>
                <th>Desenvolvedora</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $jogosDes->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>
                    <td><?php echo $row['nomeJogo']; ?></td>
                    <td><?php echo "<img src='../uploads/" . $row['ImgJogo'] . "' alt='Foto do " . $row['nomeJogo'] . "'"; ?></td>
                    <td><?php echo $row['fk_desenvolvedora']; ?></td>
                    <td><?php echo $row['precoJogo']; ?></td>
                    <td>
                        <a href="../deletar.php?cargo=4&id=<?php echo $row['idJogo']; ?>"><img id="imgalt" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcx1AupvWZqkA2_GijfJIDCsc1xCNXVNOkDQ&s" alt=""></a>
                        <a href="../editar.php?cargo=4&id=<?php echo $row['idJogo']; ?>"><img id="imgex" src="https://cdn.pixabay.com/photo/2017/06/06/00/33/edit-icon-2375785_640.png" alt=""></a>
                        <a href="../jogo.php?id=<?php echo $row['idJogo']; ?>"><img id="imgver" src="../assets/olho.png" alt=""></a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

    </main>

</body>

</html>