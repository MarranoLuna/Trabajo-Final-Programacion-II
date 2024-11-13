<!DOCTYPE html>
<html lang="en">
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
                <a href="../ABM alumno/lista_alumnos.php" class="opcion">Alumnos</a>
            </div>
            <div class="menu-item">
                <a href="lista_materias.php" class="opcion">Materias</a>
            </div>
            <div class="menu-item">
                <a href="../ABM instituto/lista_institutos.php" class="opcion">Institutos</a>
            </div>
            <div class="menu-item">
                <a href="../requisitos/requisitos.php" class="opcion">Requisitos</a>
            </div>
            <a href="../asistencia.php" class="btn btn-inicio" >Inicio</a>
            <a href="../login.php" class="btn btn-cerrar-sesion" >Cerrar Sesión</a>
        </nav>
    </header>

<?php
require "../database.php"; 
$db = new Database();
$cue = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cue'])) {
    $cue = $_POST["cue"];
} elseif (isset($_GET['cue'])) {
    $cue = $_GET["cue"];
}


if ($cue) {
    $materias = $db-> traer_materias_por_instituto($cue);
    
    echo "<div class='contenedor'>";
    echo "<h1 class='textos'>Listado de Materias</h1>";
    echo "<table border='1' id='tablaInfoMaterias'>";
    echo "<tr>";
    echo "<th class='textosTabla'>ID materia</th>";
    echo "<th class='textosTabla'>Materia</th>";
    echo "<th class='textosTabla'>Acciones</th>";
    echo "</tr>";
    
    if (!empty($materias)) {
        foreach ($materias as $materia) {
            $id_materia = $materia['id_materia'];
            echo "<tr>
                    <td class='textosTabla'>{$materia['id_materia']}</td>
                    <td class='textosTabla'>{$materia['materia']}</td>
                    <td class='textosTabla'>
                    <div class='iconos'>
                        <a href='modificacion_materia.php?id_materia={$id_materia}&cue={$cue}' title='Editar'>
                            <i class='fas fa-pencil-alt'></i> 
                        </a>
                        <a href='baja_materia.php?id_materia={$id_materia}&cue={$cue}' title='Eliminar'
                        onclick='return confirmarEliminacion();'>
                            <i class='fas fa-trash'></i> 
                        </a>
                        <a href='ver_alumnos_materias.php?id_materia={$id_materia}&cue={$cue}' title='Ver Alumnos'>
                            <i class='fas fa-user'></i> 
                        </a>
                    </div>
                </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No se encontraron materias</td></tr>";
    }
    echo "</table>";
} 
?>
<div class="contenedorBoton">
<button id="boton_enviar" onclick="location.href='alta_materia.php'">Nuevo</button>
</div>
</div>

<script>
function confirmarEliminacion() {
    return confirm("¿Está seguro de que desea eliminar definitivamente la materia?");
}
</script>
</body>
</html>