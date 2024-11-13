<?php
session_start();
require '../database.php';
$db = new Database;

    $cue = $_POST['cue'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $id_requisito = 1;

    $db -> modificar_instituto($nombre, $direccion, $cue, $id_requisito);


header("Location: lista_institutos.php");
exit;
