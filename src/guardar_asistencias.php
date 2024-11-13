<?php
session_start();
require "database.php";
$bd = new Database;

$fecha=$_POST["fecha"];
$id_materia=$_POST["id_materia"];

foreach ($_POST as $key => $value) {//$_POST es un array asociativo en PHP que contiene los datos que el usuario ha enviado a través de un         formulario HTML utilizando el método POST
    //$key: Es la clave del elemento actual del array $_POST
    // Verificar si la clave comienza con 'asistencia_' (es decir, los campos relacionados con la asistencia)
    if (strpos($key, 'asistencia_') === 0) {  //strpos($key, 'asistencia_'): La función strpos busca la cadena 'asistencia_' al principio de la clave. Si la clave comienza con 'asistencia_', significa que es un campo relacionado con la asistencia. === 0: Se asegura de que 'asistencia_' esté al inicio de la clave

        $dni = str_replace('asistencia_', '', $key);  //elimina la parte 'asistencia_' de la clave, dejando solo el DNI del alumno. 
        
        $estado_asistencia = $value;

        $bd->guardar_asistencia($dni,$id_materia,$fecha, $estado_asistencia);
    }
}
$_SESSION['mensaje'] = "Asistencia guardada con éxito";
header("Location: tomar_asistencia.php?id_materia=$id_materia&fecha=$fecha");
?>
