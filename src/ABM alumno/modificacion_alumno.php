<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/estilos.css">
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
session_start();
require "../database.php";

if (isset($_GET['dni'])) {
    $dni = $_GET['dni'];
    $cue = $_GET['cue'];
    $db = new Database();
    $alumno = $db->buscar_alumno($dni);

    if ($alumno) {
        $_SESSION['alumno'] = $alumno; 
    } else {
        unset($_SESSION['alumno']); 
        $_SESSION['mensaje'] = "El alumno no existe en la base de datos.";
    }
} else {
    $_SESSION['mensaje'] = "No se proporcionó ningún DNI.";
    unset($_SESSION['alumno']);
}
?>


<?php if (isset($_SESSION['alumno'])): 
    $alumno = $_SESSION['alumno']; 
    unset($_SESSION['alumno']);
?>
    <form action="procesar_modificacion_alumno.php" method="POST" id="formModificarAlumno">
        <?php
        if (isset($_SESSION['mensaje'])) {
            echo "<div class='dni'>" . $_SESSION['mensaje'] . "</div>";
            unset($_SESSION['mensaje']); // Elimina el mensaje después de mostrarlo
        }
        ?>
        <h1 class="textos">Modificar Datos del Alumno</h1>

        <input type="hidden" name="dni"  max="100000000" value="<?= $alumno['dni'] ?>">
        <input type="hidden" name="cue" value="<?= $cue ?>">

        <input type="text" name="nombre" class="input" placeholder="Nombre" maxlength="30" value="<?= htmlspecialchars($alumno['nombre']); ?>">
        <input type="text" name="apellido" class="input" placeholder="Apellido" maxlength="30" value="<?= htmlspecialchars($alumno['apellido']); ?>">
        <input type="email" name="email" class="input" placeholder="Email" maxlength="30" value="<?= htmlspecialchars($alumno['email']); ?>">
        <input type="date" name="fecha_nacimiento" class="input" value="<?= htmlspecialchars($alumno['fecha_nacimiento']); ?>">


        <button id="boton_enviar" type="submit">GUARDAR CAMBIOS</button>
    </form>
<?php else: ?>
    <p>No se encontró información para el alumno especificado.</p>
<?php endif; ?>




</html>