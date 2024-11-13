<?php
session_start();
require "../database.php";

$bd = new Database();

$requisito = 1;
$cue = $_POST["cue"];
$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];

if($bd->exists_instituto($cue)){
    $_SESSION['mensaje'] = "El 'CUE' ingresado ya existe";
    header("Location: alta_instituto.php");
}else{
    $insertar = $bd->alta_instituto($cue, $nombre, $direccion, $requisito);
    header("Location: lista_institutos.php");

}

?>