<?php
session_start(); 

require "../database.php";

$bd = new Database();

$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$dni = $_POST["dni"];
$email = $_POST["email"];
$fecha_nacimiento = $_POST["fecha_nacimiento"];
$cue = $_POST["cue"];
$materiasSeleccionadas = $_POST['materias'] ?? [];
var_dump($materiasSeleccionadas);

$existe = $bd->exists_alumno($dni);

if ($existe) {
    $_SESSION['mensaje'] = "DNI ingresado ya existente"; 
    header("Location: alta_alumno.php"); 
    exit();
} 

$insertar = $bd->alta_alumno($dni, $nombre, $apellido, $email, $fecha_nacimiento, $cue);
    foreach ($materiasSeleccionadas as $id_materia) {
            $bd->vincular_alumno_materia($dni, $id_materia); 
        }


header("Location: ver_lista_alumnos.php?cue=$cue"); 
exit();
?>

