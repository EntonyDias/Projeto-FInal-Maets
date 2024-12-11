<?php
session_start();
include_once 'db/config.php';
include_once 'class/Usuario.php';
include_once 'class/Administrador.php';
include_once 'class/Desenvolvedora.php';
include_once 'class/Jogos.php';


$usu = new Usuario($db);
$des = new Desenvolvedora($db);
$adm = new Administrador($db);
$jog = new Jogo($db);



if (isset($_GET['id'])) {

    $cargo = $_GET['cargo'];
    $id = $_GET['id'];


    if ($cargo == 1) {

    $usu->deletar($id);

        if (isset($_SESSION['adm'])) {
            header('Location: ./adm/centralAdm.php');
            exit();
        } else {
            header('Location: index.php');
            exit();
        }
    } else if ($cargo == 2) {
        $adm->deletar($id);

        if (isset($_SESSION['adm'])) {
            header('Location: ./adm/centralAdm.php');
            exit();
        } else {
            header('Location: index.php');
            exit();
        }
    } else if($cargo == 3){
        $des->deletar($id);

        if (isset($_SESSION['adm'])) {
            header('Location: ./adm/centralAdm.php');
            exit();
        } else {
            header('Location: index.php');
            exit();
        }
    } else {
        $jog->deletar($id);

            if (isset($_SESSION['adm'])) {
                header('Location: ./adm/centralAdm.php');
                exit();
            } else {
                header('Location: ./desenvolvedora/gerenciarDes.php');
                exit();
            }
        }
}
