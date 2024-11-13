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
$id_materia = null;
$requisitos = $db->requisitos();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cue']) && isset($_POST['id_materia'])) {
    $cue = $_POST["cue"];
    $id_materia = $_POST["id_materia"];
} elseif (isset($_GET['cue']) && isset($_GET['id_materia'])) {
    $cue = $_GET["cue"];
    $id_materia = $_GET["id_materia"];
}

    $alumnos = $db->traer_alumnos($cue, $id_materia);
    
    echo "<div class='contenedorAlumnosMaterias'>";
    echo "<h1 class='textos'>Listado de Alumnos</h1>";
    echo "<table border='1' id='tablaInfoAlumnos'>";
    echo "<tr>";
    echo "<th class='textosTabla'>Nombre</th>";
    echo "<th class='textosTabla'>Apellido</th>";
    echo "<th class='textosTabla'>Email</th>";
    echo "<th class='textosTabla'>Parcial 1</th>";
    echo "<th class='textosTabla'>Parcial 2</th>";
    echo "<th class='textosTabla'>Trabajo Final</th>";
    echo "<th class='textosTabla'>Asistencia</th>";
    echo "<th class='textosTabla'>Estado</th>";
    echo "<th class='textosTabla'>Acciones</th>";
    echo "</tr>";
    
    if (!empty($alumnos)) {
        foreach ($alumnos as $alumno) {
            $dni = $alumno["dni"];
            $diasTotales = $db -> total_asistencias($dni,$id_materia);
            $diasPresentes = $db -> total_asistencias_presentes($dni,$id_materia);
            if ($diasTotales > 0) {
                $porcentajeAsistencia = number_format(($diasPresentes / $diasTotales) * 100, 2);
            } else {
                $porcentajeAsistencia = "";
            }
            $examenes = $db->traer_examenes_por_materia($id_materia, $dni);
            $notaParcial1 = $notaParcial2 = $notaTrabajoFinal = " ";

            foreach ($examenes as $examen) {
                switch ($examen['id_examen']) {
                    case 1:
                        $notaParcial1 = $examen['nota'];
                        break;
                    case 2:
                        $notaParcial2 = $examen['nota'];
                        break;
                    case 3:
                        $notaTrabajoFinal = $examen['nota'];
                        break;
                }
            }
            $estado = "";

            if (!is_numeric($notaParcial1) || !is_numeric($notaParcial2) || !is_numeric($notaTrabajoFinal) || !is_numeric($porcentajeAsistencia)) {
                $estado = ""; 
            } else {
                if ($notaParcial1 >= $requisitos['promocion_nota'] && 
                    $notaParcial2 >= $requisitos['promocion_nota'] && 
                    $notaTrabajoFinal >= $requisitos['promocion_tp'] && 
                    $porcentajeAsistencia >= $requisitos['promocion_asistencia']) {
                    
                    $estado = "promocion";
                }
                else if ($notaParcial1 >= $requisitos['regularizar_nota'] && 
                         $notaParcial2 >= $requisitos['regularizar_nota'] && 
                         $notaTrabajoFinal >= $requisitos['regularizar_tp'] && 
                         $porcentajeAsistencia >= $requisitos['regularizar_asistencia']) {
                    
                    $estado = "regular";
                }
                else {
                    $estado = "libre";
                }
            }
            

        
            
            
            echo "<tr>
                    <td class='textosTabla'>{$alumno['nombre']}</td>
                    <td class='textosTabla'>{$alumno['apellido']}</td>
                    <td class='textosTabla'>{$alumno['email']}</td>
                    <td class='textosTabla'>{$notaParcial1}</td>
                    <td class='textosTabla'>{$notaParcial2}</td>
                    <td class='textosTabla'>{$notaTrabajoFinal}</td>
                    <td class='textosTabla'>{$porcentajeAsistencia}%</td>
                    <td class='textosTabla'>{$estado}</td>
                    <td class='textosTabla'>
                    <div class='iconos'>
                        <a href='../ABM alumno/agregar_nota.php?dni={$dni}&id_materia={$id_materia}&cue={$cue}' title='Agregar Nota'>
                            <i class='fas fa-sticky-note'></i> 
                        </a>
                    </div>
                </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No se encontraron alumnos para esta materia.</td></tr>";
    }
    echo "</table>";
?>
</div>
<script>
function confirmarEliminacion() {
    return confirm("¿Está seguro de que desea eliminar definitivamente al alumno?");
}
</script>





</body>
</html>