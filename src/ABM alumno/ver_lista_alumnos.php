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
                <a href="lista_alumnos.php" class="opcion">Alumnos</a>
            </div>
            <div class="menu-item">
                <a href="../ABM materia/lista_materias.php" class="opcion">Materias</a>
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



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cue']) ) {
    $cue = $_POST["cue"];
} elseif (isset($_GET['cue'])) {
    $cue = $_GET["cue"];
}

if ($cue) {
    $alumnos = $db->traer_alumnos_por_instituto($cue);
    echo "<div id='contenedorTabla'>";
    echo "<h1 class='textos'>Listado de Alumnos</h1>";
    echo "<table border='1' id='tablaInfoAlumnos'>";
    echo "<tr>";
    echo "<th class='textosTabla'>Nombre</th>";
    echo "<th class='textosTabla'>Apellido</th>";
    echo "<th class='textosTabla'>Dni</th>";
    echo "<th class='textosTabla'>Email</th>";
    echo "<th class='textosTabla'>Nacimiento</th>";
    echo "<th class='textosTabla'>Acciones</th>";
    echo "</tr>";
    
    if (!empty($alumnos)) {
        foreach($alumnos as $alumno){
            $dni = $alumno['dni'];
            echo "<tr>
                    <td class='textosTabla'>{$alumno['nombre']}</td>
                    <td class='textosTabla'>{$alumno['apellido']}</td>
                    <td class='textosTabla'>{$alumno['dni']}</td>
                    <td class='textosTabla'>{$alumno['email']}</td>
                    <td class='textosTabla'>{$alumno['fecha_nacimiento']}</td>
                    <td class='textosTabla'>
                    <div class='iconos'>
                        <a href='modificacion_alumno.php?dni={$dni}&cue={$cue}' title='Editar'>
                            <i class='fas fa-pencil-alt'></i> 
                        </a>
                        <a href='baja_alumno.php?dni={$dni}&cue={$cue}' title='Eliminar' 
                            onclick='return confirmarEliminacion();'>
                            <i class='fas fa-trash'></i> 
                        </a>
                        <a href='vincular_alumno_materia.php?dni={$dni}' title='Vincular'>
                            <i class='fas fa-link'></i>
                        </a>
                    </div>
                </td>
                </tr>";
        }   
        
        }
    } else {
        echo "<tr><td colspan='7'>No se encontraron alumnos para esta materia.</td></tr>";
    }
    echo "</table>";
    
?>
<div class="contenedorBoton">
    <button id="boton_enviar" onclick="location.href='alta_alumno.php?cue=<?php echo $cue; ?>'">Nuevo</button>
</div>
</div>

<script>
function confirmarEliminacion() {
    return confirm("¿Está seguro de que desea eliminar definitivamente al alumno?");
}
</script>
    
           
</body>
</html>