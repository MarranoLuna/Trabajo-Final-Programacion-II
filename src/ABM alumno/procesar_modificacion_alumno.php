<?php
session_start();
require '../database.php';

$db = new Database();


    $cue=$_POST['cue'];
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    $db->modificar_alumno($dni, $nombre, $apellido, $email, $fecha_nacimiento);

header("Location: ver_lista_alumnos.php?cue=$cue");
        exit();

