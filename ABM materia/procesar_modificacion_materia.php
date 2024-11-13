<?php
session_start();
require '../database.php';
$db = new Database;

    $id_materia = $_POST['id_materia'];
    $materia = $_POST['materia'];
    $cue = $_POST['cue'];
    $nombreInstituto = $_POST['nombre_instituto'];

    $db->modificar_materia($materia, $cue, $id_materia);

header("Location: ver_lista_materias.php?cue=$cue");
exit;

?>