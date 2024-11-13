<?php
    session_start();
    require "../database.php";
    $db = new Database;

    $dni = $_POST['dni'];
    $cue = $_POST['cue'];
    $id_materia = $_POST['id_materia'];
    $examen = $_POST['examen'];
    $nota = $_POST['nota'];

    $db -> guardar_notas($dni, $examen, $id_materia, $nota);

    header("Location: ../ABM materia/ver_alumnos_materias.php?id_materia=$id_materia&cue=$cue");
    exit;

?>