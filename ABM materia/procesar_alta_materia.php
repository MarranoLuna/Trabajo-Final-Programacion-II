<?php
session_start();
require "../database.php";

$bd = new Database();

$materia = $_POST["materia"];
$cue = $_POST['cue'];

if($bd->exists_materia($materia,$cue)){
    $_SESSION['mensaje'] = "La materia ya existe en el instituo seleccionado";
    header("Location: alta_materia.php");
}else{
    $bd->alta_materia($materia, $cue);
    header("Location: ver_lista_materias.php?cue=$cue");
}



?>

