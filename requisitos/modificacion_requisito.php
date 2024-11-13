
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/estilos.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <img src="../imagenes/logo.png" alt="Logo" class="logo">

        <nav class="menu">
            <div class="menu-item">
                <a href="requisitos.php" class="opcion">Requisitos</a>
            </div>
            <div class="menu-item">
                <a href="../ABM alumno/lista_alumnos.php" class="opcion">Alumnos</a>
            </div>
            <div class="menu-item">
                <a href="../ABM materia/lista_materias.php" class="opcion">Materias</a>
            </div>
            <div class="menu-item">
                <a href="../ABM instituto/lista_institutos.php" class="opcion">Institutos</a>
            </div>
            <a href="../asistencia.php" class="btn btn-inicio" >Inicio</a>
            <a href="../login.php" class="btn btn-cerrar-sesion" >Cerrar Sesión</a>
        </nav>
    </header>



<?php
require "../database.php";
$db = new Database;
$requisitos = $db->requisitos();

$tipo = $_GET["tipo"];


echo "<div class='contenedor'>";
echo "<form action='procesar_modificacion_requisito.php' method='POST' id='formModificacionRequisito'>";
echo "<h1 class='textos'>Requisitos</h1>";
echo "<table border='1' id='tablaModifRequisitos'>";
echo "<tr>";
echo "<th class='textosTabla'></th>";
echo "<th class='textosTabla'>Parciales</th>";
echo "<th class='textosTabla'>Trabajo Final</th>";
echo "<th class='textosTabla'>Asistencia</th>";
echo "</tr>";

echo "<tr>";
if ($tipo == "promocion") {
    echo "<td class='textosTabla'>Promocion</td>
          <td class='textosTabla'><input type='number' name='parciales' max='10' value='{$requisitos['promocion_nota']}'></td>
          <td class='textosTabla'><input type='number' name='trabajo' max='10' value='{$requisitos['promocion_tp']}'></td>
          <td class='textosTabla'><input type='number' name='asistencia' max='100' value='{$requisitos['promocion_asistencia']}'></td>
          <input type='hidden' name='tipo' value='{$tipo}'>";
        
} else {
    echo "<td class='textosTabla'>Regular</td>
          <td class='textosTabla'><input type='number' name='parciales'  max='10' value='{$requisitos['regularizar_nota']}'></td>
          <td class='textosTabla'><input type='number' name='trabajo'  max='10' value='{$requisitos['regularizar_tp']}'></td>
          <td class='textosTabla'><input type='number' name='asistencia'  max='100' value='{$requisitos['regularizar_asistencia']}'></td>
          <input type='hidden' name='tipo' value='{$tipo}'>";

}
echo "</tr>";

echo "</table>";
echo "<div class='boton-contenedor'>";
echo "<button id='boton_enviar' type='submit'>Guardar</button>";
echo "</div>";
echo "</form>";
echo "</div>";
?>


</body>
</html>
                    