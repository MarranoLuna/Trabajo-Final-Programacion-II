<?php

require "../database.php";

$db = new Database;

$parciales = $_POST['parciales'];
$trabajo = $_POST['trabajo'];
$asistencia = $_POST['asistencia'];
$tipo = $_POST['tipo'];

if($tipo == "promocion"){
    $db->guardarRequisitoPromocion($parciales,$trabajo,$asistencia);
}else{
    $db->guardarRequisitoRegular($parciales,$trabajo,$asistencia);
}

header("Location: requisitos.php");



?>