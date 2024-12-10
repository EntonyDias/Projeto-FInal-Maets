<?php
session_start();
include_once 'db/config.php';
include_once 'class/Usuario.php';
include_once 'class/Administrador.php';
include_once 'class/Desenvolvedora.php';


$usu = new Usuario($db);
$des = new Desenvolvedora($db);
$adm = new Administrador($db);



if (isset($_GET['id'])) {

    $cargo = $_GET['cargo'];
    $id = $_GET['id'];

switch ($cargo) {
    case 'usu':
 
            $usu->deletar($id);

              if (isset($_SESSION['adm'])) {
                header('Location: ../adm/centralAdm.php');
                exit();
                header('Location: index.php');
            }else{
                exit();
            
            }
        

        break;
    case 'des':


break;  
    case 'adm':

break;  

    default:
 break;
}
}